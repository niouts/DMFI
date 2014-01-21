<?php
/**
 * Services
 */
/**
 * Définition du service navigation
 * @package DMFI\Administration\Service
 * @author GFI
 */
class Administration_Service_Navigation
{
	/**
	 * @var Zend_Navigation objet navigation
	 */
	private $_navigation;
	
	/**
	 * Récupération de l'objet navigation
	 * @return Zend_Navigation $_navigation
	 */
	public function getNavigation() 
	{
		return $this->_navigation;
	}

	/**
	 * Affectation de l'objet navigation
	 * @param Zend_Navigation $navigation
	 * @return Administration_Service_Navigation
	 */
	public function setNavigation($navigation) 
	{
		$this->_navigation = $navigation;
		return $this;
	}

	/**
	 * Initialisation de la navigation
	 */
	public function __construct()
	{
		$navigation = array(
			array(
		        'label' => '',
				'class' => 'accueil',
		        'uri' => '/',
		    	),
		   	array(
		        'label' => 'articles',
		        'module' => 'administration',
		        'controller' => 'article',
		    	'resource' => 'article'
		    ),
		        
			array(
		        'label' => 'transverses',
		        'module' => 'administration',
		        'controller' => 'transverse',
		    	'resource' => 'transverse'
		    ),
		        
			array(
		        'label' => 'rubriques',
		        'module' => 'administration',
		        'controller' => 'rubrique',
		    	'resource' => 'rubrique'
		    ),
		        
			array(
		        'label' => 'utilisateurs',
		        'module' => 'administration',
		        'controller' => 'utilisateur',
		    	'resource' => 'utilisateur'
		    ),
			array(
		        'label' => 'just one click',
		        'module' => 'administration',
		        'controller' => 'justoneclick',
		    	'resource' => 'justoneclick'
		    ),
			array(
		        'label' => 'paramètres',
		        'module' => 'administration',
		        'controller' => 'parametre',
		    	'resource' => 'parametre'
		    ),
		);
					
		$utilisateur = Application_Service_Session::get('Utilisateur');
		if ($utilisateur) {
			$navigation[] = array(
		        'label' => $utilisateur->getPrenom().' '.$utilisateur->getNom(),
		        'uri' => '#',
		        'class' => 'droite deconnexion'
		    );
		}
		
		$this->_navigation = new Zend_Navigation($navigation);
	}
}
