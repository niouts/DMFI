<?php
/**
 * mapper des tables
 */
/**
 * mapper de la table T_ARTICLE
 * @package DMFI\Models\mappers
 * @author GFI
 */
class Application_Model_Mapper_Article extends Application_Model_Mapper_Abstract
{
	/**
     * Retourne un objet selon son Adresse
     * @param string $adresse
     * @throws Exception
     * @return Application_Model_Object_Article
     */
	public function findByAdresse($adresse)
	{
		$row = $this->getDbTable()->fetchRow('art_adresse = \''.$adresse.'\'');
		
		if (!$row) {
			throw new Exception("Could not find row $adresse");
		}

		return new $this->_object($row->toArray());
	}
	
	/**
     * Détermine si l'adresse est unique pour la sous rubrique
     * @param string $adresse
     * @param int $sousRubriqueId
     * @param int $articleId
     * @return bool
     */
	public function adresseIsUnique($adresse, $sousRubriqueId, $articleId = 0)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$and = ($articleId > 0) ? ' AND art_id != '.$articleId : '';
		$nb = $db->fetchOne(
		    'SELECT COUNT(1) FROM `t_article` WHERE art_adresse = \''.$adresse.
		    '\' AND srub_id = '.$sousRubriqueId.$and
		);
		return ($nb == 0);
	}
}