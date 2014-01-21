<?php
/**
 * Définition des tables
 */
/**
 * Définition de la table T_ARTICLE
 * @package DMFI\Models\DbTable
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Db_Table_Abstract.html
 * Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Article extends Zend_Db_Table_Abstract
{
	/**
	 * @var string nom de la table
	 */
    protected $_name = 't_article';
    
	/**
	 * @var string nom de la clé primaire
	 */
    protected $_primary  = 'art_id';
    
	/**
	 * @var string[] Définition des clés étrangères
	 */
    protected $_referenceMap    = array(
		'SousRubrique' => array(
			'columns'           => 'srub_id', //clef de la table en cours
			'refTableClass'     => 'Application_Model_DbTable_SousRubrique', // objet cible
			'refColumns'        => 'srub_id' // id de la table cible
			),
		'Utilisateur' => array(
			'columns'           => 'uti_id', //clef de la table en cours
			'refTableClass'     => 'Application_Model_DbTable_Utilisateur', // objet cible
			'refColumns'        => 'uti_id' // id de la table cible
			),
		);
    
}
