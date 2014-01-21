<?php
/**
 * Définition des tables
 */
/**
 * Définition de la table T_PARAMETRE
 * @package DMFI\Models\DbTable
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Db_Table_Abstract.html
 * Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Parametre extends Zend_Db_Table_Abstract
{
    /**
	 * @var string nom de la table
	 */
    protected $_name = 't_ref_parametre';
    
    /**
	 * @var string nom de la clé primaire
	 */
    protected $_primary = 'prm_id';
    
}
