<?php
/**
 * Services
 */
/**
 * Définition du service des articles
 * @package DMFI\Administration\Service
 * @author GFI
 */
class Administration_Service_Article
{
	/**
	 * Chargement de la liste des articles en fonction du profil, 
	 * Administrateur : tout,
	 * Rédacteur : articles attachés aux rubriques affectées
	 * @return Application_Model_Object_Article[] 
	 */
	public static function getListeArticles() 
	{
		$utilisateur = Application_Service_Session::get('Utilisateur');
		
		if (!$utilisateur) {
			$redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
    		$redirector->goto('administration/login');
		}
		
		$isAdmin = ($utilisateur->getProfile()->getLibelle() == 'Administrateur');
		
		$aArticles = array();
		if ($isAdmin) {
			$aArticles = Application_Model_Object_Article::all('art_transverse = 0');        
		} else {
			$mapper = new Application_Model_Mapper_SousRubrique();
			$idSousRubriques = $mapper->findByUtilisateur($utilisateur->getId());
			
			if (count($idSousRubriques)) {
				$aArticles = Application_Model_Object_Article::all('srub_id IN ('.implode(',', $idSousRubriques).')');	
			}
		}
		
		return $aArticles;
	}
	
}
