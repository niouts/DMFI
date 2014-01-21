<?php
/**
 * mapper des tables
 */
/**
 * mapper de la table T_REF_JUST_ONE_CLICK
 * @package DMFI\Models\mappers
 * @author GFI
 */
class Application_Model_Mapper_JustOneClick extends Application_Model_Mapper_Abstract
{

	/**
	 * Retourne l'ordre maximum
	 */
	public static function getOrdreMax()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$ordre = $db->fetchOne('SELECT MAX(joc_ordre) FROM `t_ref_just_one_click`');
		return $ordre;
	}
}