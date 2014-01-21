<?php
/**
 * Définition des tables
 */
/**
 * Définition de la table T_PROFILE
 * @package DMFI\Models\DbTable
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Db_Table_Abstract.html
 * Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Profile extends Zend_Db_Table_Abstract
{
    /**
	 * @var string nom de la table
	 */
    protected $_name = 't_profile';
    
    /**
	 * @var string nom de la clé primaire
	 */
    protected $_primary = 'pro_id';
        
}
