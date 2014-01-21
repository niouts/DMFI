<?php
/**
 * Définition des tables
 */
/**
 * Définition de la table T_RUBRIQUE
 * @package DMFI\Models\DbTable
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Db_Table_Abstract.html
 * Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Rubrique extends Zend_Db_Table_Abstract
{
	/**
	 * @var string nom de la table
	 */
    protected $_name = 't_rubrique';
    
    /**
	 * @var string nom de la clé primaire
	 */
    protected $_primary = 'rub_id';
    
}
