<?php
/**
 * Services
 */
/**
 * Définition du service des sous rubriques
 * @package DMFI\Administration\Service
 * @author GFI
 */
class Administration_Service_SousRubrique
{
	/**
	 * Chargement de la liste des sous rubriques en fonction du profil, 
	 * Administrateur : tout,
	 * Rédacteur : sous rubriques attachées aux rubriques affectées
	 * @return Application_Model_Object_SousRubrique[] 
	 */
	public static function getListeSousRubriques() 
	{
		$utilisateur = Application_Service_Session::get('Utilisateur');
		
		if (!$utilisateur) {
			$redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
    		$redirector->goto('administration/login');
		}
		
		$isAdmin = ($utilisateur->getProfile()->getLibelle() == 'Administrateur');
		
		$aSousRub = array();
		if ($isAdmin) {
			$aSousRub = Application_Model_Object_SousRubrique::all();        
		} else {
			$mapper = new Application_Model_Mapper_SousRubrique();
			$idSousRubriques = $mapper->findByUtilisateur($utilisateur->getId());
			
			if (count($idSousRubriques)) {
				$aSousRub = Application_Model_Object_SousRubrique::all(
				    'srub_id IN ('.implode(',', $idSousRubriques).')'
				);	
			}
		}
		
		return $aSousRub;
	}
	
}
