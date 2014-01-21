<?php
/**
 * objets des tables
 */
/**
 * Définition de l'objet parametre
 * @package DMFI\Models\Object
 * @author GFI
 */
class Application_Model_Object_Parametre extends Application_Model_Object_Abstract
{
	/**
	 * @var string $_prefix prefixe des champs de la table
	 */
	protected $_prefix = 'prm_';
	
	/**
	 * @var int $id id.
	 */
	protected $id;
	/**
	 * @var string $code code.
	 */
	protected $code;
	/**
	 * @var string $valeur valeur.
	 */
	protected $valeur;
	
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
	 * @return Application_Model_Object_Parametre
	 */
	public function setId($id) 
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * Retourne le code
	 * @return string $code
	 */
	public function getCode() 
	{
		return $this->code;
	}

	/**
	 * Affecte le code
	 * @param string $code
	 * @return Application_Model_Object_Parametre
	 */
	public function setCode($code) 
	{
		$this->code = $code;
		return $this;
	}

	/**
	 * Retourne la valeur
	 * @return string $valeur
	 */
	public function getValeur() 
	{
		return $this->valeur;
	}

	/**
	 * Affecte la valeur
	 * @param string $valeur
	 * @return Application_Model_Object_Parametre
	 */
	public function setValeur($valeur) 
	{
		$this->valeur = $valeur;
		return $this;
	}
			
}