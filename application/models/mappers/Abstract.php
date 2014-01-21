<?php
/**
 * Définition des mappers
 */
/**
 * Définition de la classe abstraite
 * @package DMFI\Models\mappers
 * @author GFI
 */
class Application_Model_Mapper_Abstract
{
	/**
	 * Nom de la table
	 * @var string
	 */
	protected $_nom;
	/**
	 * Objet DbTable
	 * @var Application_Model_DbTable_*
	 */
	protected $_dbTable;
	/**
	 * Objet de reference
	 * @var Application_Model_Object_*
	 */
	protected $_object;
	/**
	 * Clef primaire de la table
	 * @var string
	 */
	protected $_primary;
	
	/**
	 * Initialisation du nom, de la clé primaire et de l'objet
	 */
	public function __construct()
	{
		$this->_nom = $this->getDbTable()->info('name');
		
		$aPrimary = $this->getDbTable()->info('primary');
		$this->_primary = $aPrimary[1];
		
		$this->_object = str_replace('Mapper', 'Object', get_class($this));
	}
	
	/**
	 * Définit l'objet Application_Model_DbTable_* Associé
	 * @param Application_Model_DbTable_* $dbTable
	 * @throws Exception
	 * @return Application_Model_Mapper_*
	 */
	public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        
        $this->_dbTable = $dbTable;
        
        return $this;
    }
 
    /**
     * Retourne l'objet Application_Model_DbTable_* Associé
     * @return Application_Model_DbTable_*
     */
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable(str_replace('Mapper', 'DbTable', get_class($this)));
        }
        return $this->_dbTable;
    }
    
    /**
     * Retourne le nom de la classe de l'objet Application_Model_DbTable_* Associé
     */
    public function getDbTableClass()
    {
    	return get_class($this->getDbTable());
    }
    
    /**
     * Retourne toutes les données de la table
     * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
     * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @return array
     */
    public function all($where=null,$order=null)
    {
    	$data = array();
    	$aAll = array();
    	
    	$data = $this->getDbTable()->fetchAll($where, $order);
    	foreach ($data->toArray() as $k=>$v) {
    		$aAll[] = new $this->_object($v);
    	}
    	
    	return $aAll;
    }
    
    /**
     * Retourne un objet
     * @param int|string|array|Zend_Db_Table_Select $param
     * @throws Exception
     * @return Application_Model_Object_*
     */
	public function find($param)
	{
		if (is_numeric($param)) {
			$row = $this->getDbTable()->fetchRow($this->_primary.' = '.$param);
		} else {
			$row = $this->getDbTable()->fetchRow($param);
		}
		
		if (!$row) {
			return null;
		}

		return new $this->_object($row->toArray());
	}
	
	/**
	 * Sauvegarde un objet
	 * @param Application_Model_Object_* $obj
	 * @param string $encodage
	 */	
	public function save(&$obj,$encodage=null)
	{
		if (!$obj->getId()) {
			$obj->setId(null);
			$obj->setId($this->getDbTable()->insert($obj->toTable($encodage)));
        } else { 
        	$this->getDbTable()->update($obj->toTable($encodage), array($this->_primary.'= ?' => $obj->getId()));
        }
	}
	
	/**
	 * Supprime un objet
	 * @param int $id
	 */
	public function delete($id)
	{
		$this->getDbTable()->delete($this->_primary.' =' . (int)$id);
	}
	
	/**
	 * Supprime des objets
	 * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
	 */
	public function deleteAll($where)
	{
		$this->getDbTable()->delete($where);
	}
	
}