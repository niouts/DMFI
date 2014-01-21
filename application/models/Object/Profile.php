<?php
/**
 * objets des tables
 */
/**
 * Définition de l'objet profile
 * @package DMFI\Models\Object
 * @author GFI
 */
class Application_Model_Object_Profile extends Application_Model_Object_Abstract
{
	/**
	 * @var string $_prefix prefixe des champs de la table
	 */
	protected $_prefix = 'pro_';
	
	/**
	 * @var int $id id.
	 */
	protected $id;
	/**
	 * @var string $libelle libelle.
	 */
	protected $libelle;
	
	/**
	 * Retourne l'id
	 * @return int $id
	 */
	public function getId() 
	{
		return $this->id;
	}

	/**
	 * Affecte l'id
	 * @param int $id
	 * @return Application_Model_Object_Profile
	 */
	public function setId($id) 
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * Retourne le libelle
	 * @return string $libelle
	 */
	public function getLibelle() 
	{
		return $this->libelle;
	}

	/**
	 * Affecte le libelle
	 * @param string $libelle
	 * @return Application_Model_Object_Profile
	 */
	public function setLibelle($libelle) 
	{
		$this->libelle = $libelle;
		return $this;
	}

	/**
	 * Retourne les objets Utilisateur
	 * @return Application_Model_Object_Utilisateur[]
	 */
	public function getUtilisateurs() 
	{
		return $this->getDependent('Utilisateur');
	}
	
	
}