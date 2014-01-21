<?php
/**
 * objets des tables
 */
/**
 * Définition de l'objet article
 * @package DMFI\Models\Object
 * @author GFI
 */
class Application_Model_Object_Article extends Application_Model_Object_Abstract
{
	/**
	 * @var string $_prefix prefixe des champs de la table
	 */
	protected $_prefix = 'art_';
	/**
	 * @var string[] $_keys liste des clés étrangères
	 */
	protected $_keys = array('srub_id', 'uti_id');
	
	/**
	 * @var int $id id.
	 */
	protected $id;
	/**
	 * @var int $srub_id sous rubrique id de l'article.
	 */
	protected $srub_id;
	/**
	 * @var int $uti_id utilisateur id de l'article.
	 */
	protected $uti_id;
	/**
	 * @var string $titre titre.
	 */
	protected $titre;
	/**
	 * @var string $contenu contenu.
	 */
	protected $contenu;
	/**
	 * @var string $adresse adresse.
	 */
	protected $adresse;
	/**
	 * @var string $creation_dt date de création.
	 */
	protected $creation_dt;
	/**
	 * @var string $maj_dt date de mis à jour.
	 */
	protected $maj_dt;
	/**
	 * @var string $fin_publication_dt date de fin de publication.
	 */
	protected $fin_publication_dt;
	/**
	 * @var string $publication_dt date de début de publication.
	 */
	protected $publication_dt;
	/**
	 * @var bool $transverse true s'il s'agit d'un article transverse.
	 */
	protected $transverse;
	
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
	 * @return Application_Model_Object_Article
	 */
	public function setId($id) 
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * Retourne l'id de la sous rubrique
	 * @return int $srub_id
	 */
	public function getSrub_id() 
	{
		return $this->srub_id;
	}

	/**
	 * Affecte l'id de la sous rubrique
	 * @param int $srubId
	 * @return Application_Model_Object_Article
	 */
	public function setSrub_id($srubId) 
	{
		$this->srub_id = $srubId;
		return $this;
	}

	/**
	 * Retourne l'id de l'utilisateur
	 * @return int $uti_id
	 */
	public function getUti_id() 
	{
		return $this->uti_id;
	}

	/**
	 * Affecte l'id de l'utilisateur
	 * @param int $utiId
	 * @return Application_Model_Object_Article
	 */
	public function setUti_id($utiId) 
	{
		$this->uti_id = $utiId;
		return $this;
	}

	/**
	 * Retourne le titre
	 * @return string $titre
	 */
	public function getTitre() 
	{
		return $this->titre;
	}

	/**
	 * Affecte le titre
	 * @param string $titre
	 * @return Application_Model_Object_Article
	 */
	public function setTitre($titre) 
	{
		$this->titre = $titre;
		return $this;
	}
	
	/**
	 * Retourne le contenu
	 * @return string $contenu
	 */
	public function getContenu() 
	{
		return $this->contenu;
	}

	/**
	 * Affecte le contenu
	 * @param string $contenu
	 * @return Application_Model_Object_Article
	 */
	public function setContenu($contenu) 
	{
		$this->contenu = $contenu;
		return $this;
	}


	/**
	 * Retourne l'adresse
	 * @return string $adresse
	 */
	public function getAdresse() 
	{
		return $this->adresse;
	}

	/**
	 * Affecte l'adresse
	 * @param string $adresse
	 * @return Application_Model_Object_Article
	 */
	public function setAdresse($adresse) 
	{
		$this->adresse = $adresse;
		return $this;
	}
	
	/**
	 * Retourne la date de création
	 * @return string $creation_dt
	 */
	public function getCreation_dt() 
	{
		return $this->creation_dt;
	}

	/**
	 * Affecte la date de création
	 * @param string $creationDt
	 * @return Application_Model_Object_Article
	 */
	public function setCreation_dt($creationDt) 
	{
		if ($creationDt == '') {
			$creationDt = null;
		}
		$this->creation_dt = $creationDt;
		return $this;
	}

	/**
	 * Retourne la date de mis à jour
	 * @return string $maj_dt
	 */
	public function getMaj_dt() 
	{
		return $this->maj_dt;
	}

	/**
	 * Affecte la date de mis à jour
	 * @param string $majDt
	 * @return Application_Model_Object_Article
	 */
	public function setMaj_dt($majDt) 
	{
		if ($majDt == '') {
			$majDt = null;
		}
		$this->maj_dt = $majDt;
		return $this;
	}

	/**
	 * Retourne la date de début de publication
	 * @return string $publication_dt
	 */
	public function getPublication_dt() 
	{
		return $this->publication_dt;
	}

	/**
	 * Affecte la date de début de publication
	 * @param string $publicationDt
	 * @return Application_Model_Object_Article
	 */
	public function setPublication_dt($publicationDt) 
	{
		if ($publicationDt == '') {
			$publicationDt = null;
		}
		$this->publication_dt = $publicationDt;
		return $this;
	}
	
	/**
	 * Retourne la date de fin de publication
	 * @return string $fin_publication_dt
	 */
	public function getFin_publication_dt() 
	{
		return $this->fin_publication_dt;
	}

	/**
	 * Affecte la date de fin de publication
	 * @param string $finPublicationDt
	 * @return Application_Model_Object_Article
	 */
	public function setFin_publication_dt($finPublicationDt) 
	{
		if ($finPublicationDt == '') {
			$finPublicationDt = null;
		}
		$this->fin_publication_dt = $finPublicationDt;
		return $this;
	}
	
	/**
	 * Retourne transverse
	 * @return bool $transverse
	 */
	public function getTransverse() 
	{
		return $this->transverse;
	}

	/**
	 * Affecte transverse
	 * @param bool $transverse
	 * @return Application_Model_Object_Article
	 */
	public function setTransverse($transverse) 
	{
		$this->transverse = $transverse;
		return $this;
	}

	/**
	 * Retourne l'objet SousRubrique
	 * @return Application_Model_Object_SousRubrique
	 */
	public function getSousRubrique() 
	{
		return $this->getParent('SousRubrique');
	}
	
	/**
	 * Retourne l'objet Utilisateur
	 * @return Application_Model_Object_Utilisateur
	 */
	public function getRedacteur() 
	{
		return $this->getParent('Utilisateur');
	}

			
}