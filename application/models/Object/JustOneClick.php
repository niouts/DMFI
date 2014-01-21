<?php
/**
 * objets des tables
 */
/**
 * Définition de l'objet JustOneClick
 * @package DMFI\Models\Object
 * @author GFI
 */
class Application_Model_Object_JustOneClick extends Application_Model_Object_Abstract
{
	/**
	 * @var string $_prefix prefixe des champs de la table
	 */
	protected $_prefix = 'joc_';
	
	/**
	 * @var int $id id.
	 */
	protected $id;
	/**
	 * @var string $libelle libelle.
	 */
	protected $libelle;
	/**
	 * @var string $lien lien.
	 */
	protected $lien;
	/**
	 * @var int ordre d'affichage du lien.
	 */
	protected $ordre;
	
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
	 * @return Application_Model_Object_JustOneClick
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
	 * @return Application_Model_Object_JustOneClick
	 */
	public function setLibelle($libelle)
	{
		$this->libelle = $libelle;
		return $this;
	}

	/**
	 * Retourne le lien
	 * @return string $lien
	 */
	public function getLien() 
	{
		return $this->lien;
	}

	/**
	 * Affecte le lien
	 * @param string $lien
	 * @return Application_Model_Object_JustOneClick
	 */
	public function setLien($lien)
	{
		$this->lien = $lien;
		return $this;
	}

	/**
	 * Retourne l'ordre d'affichage
	 * @return int $ordre
	 */
	public function getOrdre() 
	{
		return $this->ordre;
	}

	/**
	 * Affecte l'ordre
	 * @param int $ordre
	 * @return Application_Model_Object_JustOneClick
	 */
	public function setOrdre($ordre) 
	{
		$this->ordre = $ordre;
		return $this;
	}
			
}