<?php
/**
 * objets des tables
 */
/**
 * Définition de l'objet utilisateur
 * @package DMFI\Models\Object
 * @author GFI
 */
class Application_Model_Object_Utilisateur extends Application_Model_Object_Abstract
{
	/**
	 * @var string $_prefix prefixe des champs de la table
	 */
	protected $_prefix = 'uti_';
	/**
	 * @var string[] $_keys liste des clés étrangères
	 */
	protected $_keys = array('pro_id');
	
	/**
	 * @var int $id id.
	 */
	protected $id;
	/**
	 * @var int $pro_id profil id de l'utilisateur
	 */
	protected $pro_id;
	/**
	 * @var string $nom nom.
	 */
	protected $nom;
	/**
	 * @var string $prenom prenom.
	 */
	protected $prenom;
	/**
	 * @var string $mail mail.
	 */
	protected $mail;
	/**
	 * @var string $login login.
	 */
	protected $login;
	/**
	 * @var string $pwd pwd.
	 */
	protected $pwd;
	
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
	 * @return Application_Model_Object_Utilisateur
	 */
	public function setId($id) 
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * Retourne l'id du profil
	 * @return int $pro_id
	 */
	public function getPro_id() 
	{
		return $this->pro_id;
	}

	/**
	 * Affecte l'id du profil
	 * @param int $proId
	 * @return Application_Model_Object_Utilisateur
	 */
	public function setPro_id($proId) 
	{
		$this->pro_id = $proId;
		return $this;
	}

	/**
	 * Retourne le nom
	 * @return string $nom
	 */
	public function getNom() 
	{
		return $this->nom;
	}

	/**
	 * Affecte le nom
	 * @param string $nom
	 * @return Application_Model_Object_Utilisateur
	 */
	public function setNom($nom) 
	{
		$this->nom = $nom;
		return $this;
	}

	/**
	 * Retourne le prenom
	 * @return string $prenom
	 */
	public function getPrenom() 
	{
		return $this->prenom;
	}

	/**
	 * Affecte le prenom
	 * @param string $prenom
	 * @return Application_Model_Object_Utilisateur
	 */
	public function setPrenom($prenom) 
	{
		$this->prenom = $prenom;
		return $this;
	}

	/**
	 * Retourne le mail
	 * @return string $mail
	 */
	public function getMail() 
	{
		return $this->mail;
	}

	/**
	 * Affecte le mail
	 * @param string $mail
	 * @return Application_Model_Object_Utilisateur
	 */
	public function setMail($mail) 
	{
		$this->mail = $mail;
		return $this;
	}

	/**
	 * Retourne le login
	 * @return string $login
	 */
	public function getLogin() 
	{
		return $this->login;
	}

	/**
	 * Affecte le login
	 * @param string $login
	 * @return Application_Model_Object_Utilisateur
	 */
	public function setLogin($login) 
	{
		$this->login = $login;
		return $this;
	}

	/**
	 * Retourne le pwd
	 * @return string $pwd
	 */
	public function getPwd() 
	{
		return $this->pwd;
	}

	/**
	 * Affecte le login
	 * @param string $pwd
	 * @param bool $md5
	 * @return Application_Model_Object_Utilisateur
	 */
	public function setPwd($pwd, $md5=false) 
	{
		if ($md5)
			$this->pwd = md5($pwd);
		else 
			$this->pwd = $pwd;
		return $this;
	}

	/**
	 * Retourne l'objet Profile
	 * @return Application_Model_Object_Profile
	 */
	public function getProfile() 
	{
		return $this->getParent('Profile');
	}

	/**
	 * Retourne les objets Rubriques liés à l'utilisateur
	 * @return Application_Model_Object_Rubrique[]
	 */
	public function getRubriques() 
	{
		return $this->getManyToMany('Rubrique', 'UtilisateurRubrique');
	}

	/**
	 * Retourne les identifiants des rubriques de l'utilisateur
	 * @return int[]
	 */
	public function getRubriquesId() 
	{
		$aId = array();
		
		foreach ($this->getRubriques() as $rub) {
			$aId[] = $rub->getId();
		}
		
		return $aId;
	}
			
}