<script type="text/javascript">
	function confirmer(){
		if(confirm('Etes vous sur de vouloir supprimer les sauvegardes ? '))
			window.location.href = 'GFI_Livraison.php?page=2';
	}
</script>

<?php
/**
 * GFI - NPU
 * Script de livraison automatique.
 * 
 * Juin 2012 - v 1.0
 */

/*
 * VARIABLES
 */
error_reporting(E_ALL);

if (!file_exists('config.ini')) {
	echo "Impossible de charger la configuration";
	die();
}
$config = parse_ini_file('config.ini');

/**
 * 
 * Type de livraison {FULL,DELTA}
 * @var string {FULL,DELTA}
 */
$type_livraison		= $config['type_livraison'];

/**
 * 
 * répertoire de livraison
 * @var string
 */
$rep_livraison 		= $config['rep_livraison'];

/**
 * 
 * répertoire d'installation
 * @var string
 */
$rep_installation 	= $config['rep_installation'];

/**
 * 
 * répertoire de sauvegarde
 * @var sting
 */
$rep_sauvegarde		= $config['rep_sauvegarde'];

/*
 * FONCTIONS 
 */

/**
 * 
 * filtre les dossier qui commence par un .
 * @param string $value
 */
function folderFilter($value) { return ('.' !== $value{0}); }

/**
 * 
 * Scan le répertoire $rep filtré par la fonction folderFilter
 * Revoi un tableau.
 *  
 * @param string $rep
 */
function lireRepertoire($rep) { return array_values(array_filter(scandir($rep), 'folderFilter')); }

/**
 * 
 * Log dans le fichier "Livraison.log" et affiche les messages.
 * @param string $texte
 */
function logguer($texte)
{
	$log = fopen('Livraison.log', 'a');
	fwrite($log, date('d/m/Y H:i:s').' '.$texte);
	fclose($log);
	echo str_replace("\n", '<br>', $texte);
}

/*
 * VERIFICATION
 */
/**
 * 
 * Vérifie les répertoires pour la livraison
 * @param string $rep_installation
 * @param string $rep_sauvegarde
 * @param string $rep_livraison
 * @throws Exception
 */
function verifier_repertoires($rep_installation,$rep_sauvegarde,$rep_livraison)
{
	//Verification des repertoires
	if( !file_exists($rep_livraison) )
		throw new Exception('ARRET , le repetoire '.$rep_livraison.' n\'existe pas ! ');

	if( !file_exists($rep_installation) )
		throw new Exception('ARRET , le repetoire '.$rep_installation.' n\'existe pas ! ');
		
	if( !file_exists($rep_sauvegarde) )
		mkdir($rep_sauvegarde, 0777, true);		
	
	$cmd = 'ls '.$rep_sauvegarde;
	exec($cmd,$output,$return);
	
	if($output)
		throw new Exception('ARRET , le repetoire '.$rep_sauvegarde.' n\'est pas vide ! ');
}

/*
 * SAUVEGARDE
 */

/**
 * 
 * Sauvegarde tout un repertoire $rep.
 * Si $rep_livraison est précisé, on ne sauvegarde que les fichiers qui seront remplacé après.
 * @param string $rep repertoire à sauvegarder.
 * @param string $destination repertoire de sauvegarde.
 * @param string $rep_livraison repertoire qui sera livré ensuite.
 */
function sauvegarder_rep($rep,$destination,$rep_livraison = NULL,$nomLog = null,&$tab=0)
{
	$log = fopen($nomLog,'a');
	$i = 0;
	$tabulation = '|----';
	foreach (lireRepertoire($rep) as $filename)
	{ 
		$fichier = $rep.DIRECTORY_SEPARATOR.$filename;
		$fichier_sauvegarde = $destination.DIRECTORY_SEPARATOR.$filename;
		
		if($rep_livraison)
			$fichier_livre = $rep_livraison.DIRECTORY_SEPARATOR.$filename;
		else
			$fichier_livre = null;

		
		//Si l'on rentre dans un dossier 
		if(is_dir($fichier))
		{	
			if(!$fichier_livre || ($fichier_livre && file_exists($fichier_livre)) )
			{	
				$tab++;
				sauvegarder_rep($fichier,$fichier_sauvegarde,$fichier_livre,$nomLog,$tab);
			}
		}
		// $fichier est bien un fichier
		else
		{
			//S'il y a un fichier à livrer et qu'il n'existe pas on ne le sauvegarde pas
			if($fichier_livre && !file_exists($fichier_livre) ) { continue;	}

			if(!is_dir($destination)) { 
				if( !mkdir($destination,0777,true) ) 
					throw new Exception('Impossible de creer le repertoire de sauvagarde '.$destination); 
			}

			if(!copy($fichier, $fichier_sauvegarde))
				throw new Exception('Erreur lors de la copie de '.$fichier.' vers '.$fichier_sauvegarde);
			
			if($i == 0)
			{
				if($tab-1>=0)
				{
					$t = $tab-1;
					$name = basename(dirname($fichier_sauvegarde));
					
					fwrite($log, str_repeat($tabulation,$t).$name.PHP_EOL);
				}
			}
			$i++;	
		
			fwrite($log, str_repeat($tabulation,$tab).$filename.PHP_EOL);
		}
	}
	$tab--;
}

/**
 * 
 * gère la sauvegarde en fonction du type de livraison.
 * Si mode DELTA : on ne sauvagarde que les fichiers qui seront remplacés.
 * Si mode FULL :  on sauvegarde tout les répertoire $rep_installation.
 * @param string $type_livraison
 * @param string $rep_installation
 * @param string $rep_sauvegarde
 * @param string $rep_livraison
 * @throws Exception
 */
function sauvegarder($type_livraison,$rep_installation,$rep_sauvegarde,$rep_livraison)
{
	//Sauvegarde du repertoire d'installation
	switch ($type_livraison)
	{
		case 'DELTA':
			$i=0;
			sauvegarder_rep($rep_installation,$rep_sauvegarde,$rep_livraison,'sauvegarder.log',$i);
		break;
		
		case 'FULL':
			sauvegarder_all($rep_installation,$rep_sauvegarde);
		break;
		
		default: throw new Exception('le type de livraison n\'est pas correcte ! ');
	}
}

/**
 * 
 * ESauvegarde tout le répertoire $rep_installation vers $rep_sauvegarde
 * @param string $rep_installation
 * @param string $rep_sauvegarde
 * @throws Exception
 */
function sauvegarder_all($rep_installation,$rep_sauvegarde)
{
	$cmd = 'cp -rpf '.$rep_installation.'/* '.$rep_sauvegarde;
	
	exec($cmd,$output,$return);
	if($return)
		throw new Exception('La sauvegarde des fichiers n\'a pas aboutie ! problème lors de la copie. ');
}

/*
 * INSTALLATION
 */

/**
 * 
 * Copie le répertoire $rep_livraison vers $rep_installation
 * @param string $rep_livraison
 * @param string $rep_installation
 * @throws Exception
 */
function installer($rep_livraison,$rep_installation)
{
	$cmd = 'cp -rpf '.$rep_livraison.'/* '.$rep_installation;
	
	exec($cmd,$output,$return);
	if($return)
		throw new Exception('L\'installation des nouveaux fichiers n\'a pas aboutie ! problème lors de la copie. ');
}

/*
 * SUPRRESSIONS
 */

/**
 * 
 * Supprime les fichiers de $rep_installation présent dans $rep_livraison
 * @param string $rep_installation
 * @param string $rep_livraison
 * @param string $nomLog
 * @param int $tab
 * @throws Exception
 */
function supprimer_rep($rep_installation,$rep_livraison,$nomLog = null,&$tab=0)
{
	$log = fopen($nomLog,'a');
	$i = 0;
	$tabulation = '|----';
	foreach (lireRepertoire($rep_livraison) as $filename)
	{ 
		$fichier 		= $rep_installation.DIRECTORY_SEPARATOR.$filename;
		$fichier_livre 	= $rep_livraison.DIRECTORY_SEPARATOR.$filename;
	
		
		//Si l'on rentre dans un dossier 
		if(is_dir($fichier_livre))
		{	
			$tab++;
			supprimer_rep($fichier,$fichier_livre,$nomLog,$tab);
		}
		// $fichier est bien un fichier
		else
		{
			if(!unlink($fichier))
				throw new Exception('Erreur lors de la suppression de '.$fichier);
				
			
			if($i == 0)
			{
				if($tab-1>=0)
				{
					$t = $tab-1;
					$name = basename(dirname($fichier));
					
					fwrite($log, str_repeat($tabulation,$t).$name.PHP_EOL);
				}
			}
			$i++;	
		
			fwrite($log, str_repeat($tabulation,$tab).$filename.PHP_EOL);
		}
	}
	$tab--;
}

/**
 * 
 * Supprime tout le répertoire $rep_installation SAUF le dossier livraison
 * @param string $rep_installation
 * @throws Exception
 */
function supprimer_all($rep_installation)
{
	foreach (lireRepertoire($rep_installation) as $filename)
	{
		if(filename != 'livraison')
		{
			$cmd = 'rm -rf '.$rep_installation.DIRECTORY_SEPARATOR.$filename;
	
			exec($cmd,$output,$return);
			if($return)
				throw new Exception('La suppression des fichiers n\'a pas aboutie ! problème lors de la suppression de '.$rep_installation.DIRECTORY_SEPARATOR.$filename);
		}
	}
	
}
/**
 * 
 * Supprime les fichiers livré.
 * Si mode DELTA : on ne supprime que les fichiers livré.
 * Si mode FULL : on supprime tout le répertoire $rep_installation sauf le dossier livraison.
 * @param string $type_livraison
 * @param string $rep_installation
 * @param string $rep_livraison
 * @throws Exception
 */
function supprimer($type_livraison,$rep_installation,$rep_livraison)
{
	switch ($type_livraison)
	{
		case 'DELTA':
			$i=0;
			supprimer_rep($rep_installation,$rep_livraison,'supprimer.log',$i);
		break;
		
		case 'FULL':
			supprimer_all($rep_installation);
		break;
		
		default: throw new Exception('le type de livraison n\'est pas correcte ! ');
	}
	
}

/**
 * 
 * Supprime tout le réperoire
 * @param string $rep_sauvegarde
 */
function supprimer_sauvegarde($rep_sauvegarde)
{
	$cmd = 'rm -r '.$rep_sauvegarde.'/* ';
	
	exec($cmd,$output,$return);
	if($return)
		throw new Exception('La suppression des fichiers de sauvegarde n\'a pas aboutie ! problème lors de la suppression. ');
}

/*
 * RETOUR ARRIERE
 */

/**
 * 
 * copie $rep_sauvegarde vers $rep_installation
 * @param string $rep_sauvegarde
 * @param string $rep_installation
 * @throws Exception
 */
function restaurer($rep_sauvegarde,$rep_installation)
{
	/*
	* Installation
	*/
	$cmd = 'cp -rpf '.$rep_sauvegarde.'/* '.$rep_installation;
	
	exec($cmd,$output,$return);
	if($return)
		throw new Exception('La restauration des fichiers n\'a pas aboutie ! problème lors de la copie. ');
}


try
{
	//* Récupération de la page demandée par l'utilisateur
	$iPage = isset($_GET['page'])?$_GET['page']:-1;
	
	
	echo "Installation Automatique mode $type_livraison<br>";
	echo "Installer la version depuis '$rep_livraison' vers '$rep_installation' : <a href='GFI_Livraison.php?page=0'> Lancement </a> </br>";
	echo "Retour arrière : <a href='GFI_Livraison.php?page=1'> Lancement </a> </br> ";
	echo "Supprimer les sauvegardes ( '$rep_sauvegarde' ) : <a href='#' onclick='confirmer();' > Lancement </a> </br>";
	echo "------------------------------------------ <br><br>";
	
	switch($iPage)
	{
		case 0 :
			logguer("/**** DEBUT Installation mode $type_livraison ****/ \n");
			
			logguer(" - Vérification des répertoires : ");
				verifier_repertoires($rep_installation,$rep_sauvegarde,$rep_livraison);
			logguer(" Ok \n");
			
			logguer(" - Sauvegarde : ");
				sauvegarder($type_livraison,$rep_installation,$rep_sauvegarde,$rep_livraison);
			logguer(" Ok \n");
			
			logguer(" - Installation : ");
				installer($rep_livraison,$rep_installation);
			logguer(" Ok \n");
			
			logguer("/**** FIN Installation ****/ \n\n");
		break;
		
		case 1:
			
			logguer("/**** DEBUT Retour Arrière ****/ \n");
			
			logguer(" - Suppression des fichiers livrés dans  : ".$rep_installation);
				supprimer($type_livraison,$rep_installation,$rep_livraison);
			logguer(" Ok \n");
			
			logguer(" - Restauration des fichiers sauvegardés : ");
				restaurer($rep_sauvegarde,$rep_installation);
			logguer(" Ok \n");
			
			
			logguer("/**** FIN Retour Arrière ****/ \n\n");
			
		break;
		case 2:
			logguer("/**** DEBUT Suppression Sauvegardes ****/ \n");
			
			logguer(" - Suppression des fichiers sauvegardés : ".$rep_sauvegarde);
				supprimer_sauvegarde($rep_sauvegarde);
			logguer(" Ok \n");

			logguer("/**** FIN Suppression Sauvegardes ****/ \n\n");
			
		break;
	}
	
	
}
catch(Exception $e)
{
	logguer("\nErreur : ".$e->getMessage()."\n\n");
}