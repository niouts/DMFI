<?php
/**
 * objets des tables
 */
/**
 * Définition de l'objet rubrique
 * @package DMFI\Models\Object
 * @author GFI
 */
class Application_Model_Object_Rubrique extends Application_Model_Object_Abstract
{
	/**
	 * @var string $_prefix prefixe des champs de la table
	 */
	protected $_prefix = 'rub_';
	
	/**
	 * @var int $id id.
	 */
	protected $id;
	/**
	 * @var string $libelle libelle.
	 */
	protected $libelle;
	/**
	 * @var string $adresse adresse.
	 */
	protected $adresse;
	/**
	 * @var string $accueil accueil.
	 */
	protected $accueil;
	
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
	 * @return Application_Model_Object_Rubrique
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
	 * @return Application_Model_Object_Rubrique
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
	 * Affecte le adresse
	 * @param string $adresse
	 * @return Application_Model_Object_Rubrique
	 */
	public function setAdresse($adresse) 
	{
		$this->adresse = $adresse;
		return $this;
	}

	/**
	 * Retourne les objets Sous rubriques
	 * @return Application_Model_Object_SousRubrique[]
	 */
	public function getSousRubriques()
	{
		return $this->getDependent('SousRubrique');
	}

	/**
	 * Retourne les objets Utilisateurs liés à la rubrique
	 * @return Application_Model_Object_Utilisateur[]
	 */
	public function getUtilisateurs() 
	{
		return $this->getManyToMany('Utilisateur', 'UtilisateurRubrique');
	}
	
	/**
	 * Retourne le contenu de l'accueil
	 * @return string $accueil
	 */
	public function getAccueil() 
	{
		return $this->accueil;
	}

	/**
	 * Affecte le contenu de l'accueil
	 * @param string $accueil
	 * @return Application_Model_Object_Rubrique
	 */
	public function setAccueil($accueil) 
	{
		$this->accueil = $accueil;
		return $this;
	}		
}