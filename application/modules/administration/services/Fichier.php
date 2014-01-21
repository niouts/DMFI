<?php
/**
 * Services
 */
/**
 * Définition du service de fichier
 * @package DMFI\Administration\Service
 * @author GFI
 */
class Administration_Service_Fichier
{
	/**
	 * Suppression du contenu d'un répertoire et du répertoire 
	 * @param string $dir
	 * @param bool $remove si volonté de supprimer le répertoire
	 * @return bool 
	 */
	public static function removedir($dir, $remove = true) 
	{
		if (!file_exists($dir)) return true;
		
		$files = array_diff(scandir($dir), array('.','..'));
	   	foreach ($files as $file) {
	    	if (is_dir("$dir/$file")) { 
	    		self::removedir("$dir/$file");
	    	} else {
	    		chmod("$dir/$file", 0777); 
	    		unlink("$dir/$file");
	    	}
	    }
	    
	    if ($remove) {
	    	return rmdir($dir);
	    }
	    
	    return true;
  	}
}
