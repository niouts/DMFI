<?php
/**
 * Services
 */
/**
 * Définition du service de gestion des acl
 * @package DMFI\Administration\Service
 * @author GFI
 */
class Administration_Service_Acl
{
	/**
	 * @var Zend_Acl objet acl
	 */
	private $_acl;

	/**
	 * Récupération de l'objet
	 * @return Zend_Acl $_acl
	 */
	public function getAcl() 
	{
		return $this->_acl;
	}

	/**
	 * Affectation de l'objet acl
	 * @param Zend_Acl $acl
	 * @return Administration_Service_Acl
	 */
	public function setAcl($acl) 
	{
		$this->_acl = $acl;
		return $this;
	}

	/**
	 * Initialisation des acl
	 */
	public function __construct()
	{
		$this->_acl = new Zend_Acl();

		$this->_acl->addRole(new Zend_Acl_Role('Defaut'));
		$this->_acl->addRole(new Zend_Acl_Role('Rédacteur'), array('Defaut'));
		$this->_acl->addRole(new Zend_Acl_Role('Administrateur'), array('Rédacteur'));
		
		$this->_acl->addResource(new Zend_Acl_Resource('error'));
		$this->_acl->addResource(new Zend_Acl_Resource('login'));
		$this->_acl->addResource(new Zend_Acl_Resource('utilisateur'));
		$this->_acl->addResource(new Zend_Acl_Resource('article'));
		$this->_acl->addResource(new Zend_Acl_Resource('transverse'));
		$this->_acl->addResource(new Zend_Acl_Resource('rubrique'));
		$this->_acl->addResource(new Zend_Acl_Resource('justoneclick'));
		$this->_acl->addResource(new Zend_Acl_Resource('parametre'));
		
		$this->_acl->allow('Defaut', array('login', 'error'));
				
		$this->_acl->allow('Rédacteur', 'article');
		
		$this->_acl->allow('Administrateur', 'transverse');		
		$this->_acl->allow('Administrateur', 'rubrique');		
		$this->_acl->allow('Administrateur', 'utilisateur');		
		$this->_acl->allow('Administrateur', 'justoneclick');		
		$this->_acl->allow('Administrateur', 'parametre');		
	}
	
}
