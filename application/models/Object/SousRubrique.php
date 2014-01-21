<?php
/**
 * objets des tables
 */
/**
 * Définition de l'objet sous rubrique
 * @package DMFI\Models\Object
 * @author GFI
 */
class Application_Model_Object_SousRubrique extends Application_Model_Object_Abstract
{
	/**
	 * @var string $_prefix prefixe des champs de la table
	 */
	protected $_prefix = 'srub_';
	/**
	 * @var string[] $_keys liste des clés étrangères
	 */
	protected $_keys = array('rub_id');
	
	/**
	 * @var int $id id.
	 */
	protected $id;
	/**
	 * @var int $rub_id rubrique id de la sous rubrique.
	 */
	/**
	 * @var string $titre titre.
	 */
	protected $rub_id;
	/**
	 * @var string $libelle libelle.
	 */
	protected $libelle;
	/**
	 * @var string $adresse adresse.
	 */
	protected $adresse;
	
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
	 * @return Application_Model_Object_SousRubrique
	 */
	public function setId($id) 
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	 * Retourne l'id de la rubrique
	 * @return int $rub_id
	 */
	public function getRub_id() 
	{
		return $this->rub_id;
	}

	/**
	 * Affecte l'id de la rubrique
	 * @param int $rubId
	 * @return Application_Model_Object_SousRubrique
	 */
	public function setRub_id($rubId)
	{
		$this->rub_id = $rubId;
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
	 * @return Application_Model_Object_SousRubrique
	 */
	public function setLibelle($libelle) 
	{
		$this->libelle = $libelle;
		return $this;
	}
	
	/**
	 * Retourne le adresse
	 * @return string $adresse
	 */
	public function getAdresse() 
	{
		return $this->adresse;
	}

	/**
	 * Affecte l'adresse
	 * @param string $adresse
	 * @return Application_Model_Object_SousRubrique
	 */
	public function setAdresse($adresse) 
	{
		$this->adresse = $adresse;
		return $this;
	}

	/**
	 * Retourne l'objet Utilisateur
	 * @return Application_Model_Object_Rubrique
	 */
	public function getRubrique()
	{
		return $this->getParent('Rubrique');
	}
			
}