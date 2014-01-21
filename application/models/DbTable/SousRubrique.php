<?php
/**
 * Définition des tables
 */
/**
 * Définition de la table T_SOUS_RUBRIQUE
 * @package DMFI\Models\DbTable
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Db_Table_Abstract.html
 * Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_SousRubrique extends Zend_Db_Table_Abstract
{
	/**
	 * @var string nom de la table
	 */
    protected $_name = 't_sous_rubrique';
    
    /**
	 * @var string nom de la clé primaire
	 */
    protected $_primary = 'srub_id';
    
    /**
	 * @var string[] Définition des clés étrangères
	 */
    protected $_referenceMap    = array(
		'Rubrique' => array(
			'columns'           => 'rub_id', //clef de la table en cours
			'refTableClass'     => 'Application_Model_DbTable_Rubrique', // objet cible
			'refColumns'        => 'rub_id' // id de la table cible
			));
    
}
