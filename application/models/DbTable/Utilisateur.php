<?php
/**
 * D�finition des tables
 */
/**
 * D�finition de la table T_UTILISATEUR
 * @package DMFI\Models\DbTable
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Db_Table_Abstract.html
 * Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Utilisateur extends Zend_Db_Table_Abstract
{
	/**
	 * @var string nom de la table
	 */
    protected $_name = 't_utilisateur';
    
    /**
	 * @var string nom de la cl� primaire
	 */
    protected $_primary = 'uti_id';
    
    /**
	 * @var string[] D�finition des cl�s �trang�res
	 */
    protected $_referenceMap    = array(
		'Profile' => array(
			'columns'           => 'pro_id', //clef de la table en cours
			'refTableClass'     => 'Application_Model_DbTable_Profile', // objet cible
			'refColumns'        => 'pro_id' // id de la table cible
			));
    
}
