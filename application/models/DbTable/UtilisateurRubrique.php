<?php
/**
 * Définition des tables
 */
/**
 * Définition de la table T_UTILISATEUR_RUBRIQUE
 * @package DMFI\Models\DbTable
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Db_Table_Abstract.html
 * Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_UtilisateurRubrique extends Zend_Db_Table_Abstract
{
    /**
	 * @var string nom de la table
	 */
    protected $_name = 't_utilisateur_rubrique';
    
    /**
	 * @var array nom de la clé primaire
	 */
    protected $_primary  = array('uti_id','rub_id');
    
    /**
	 * @var string[] Définition des clés étrangères
	 */
    protected $_referenceMap    = array(
        'Utilisateur' => array(
            'columns'           => array('uti_id'),
            'refTableClass'     => 'Application_Model_DbTable_Utilisateur',
            'refColumns'        => array('uti_id')
        ),
        'Rubrique' => array(
            'columns'           => array('rub_id'),
            'refTableClass'     => 'Application_Model_DbTable_Rubrique',
            'refColumns'        => array('rub_id')
        )
    );
    
}
