<?php
/**
 * mapper des tables
 */
/**
 * mapper de la table T_RUBRIQUE
 * @package DMFI\Models\mappers
 * @author GFI
 */
class Application_Model_Mapper_Rubrique extends Application_Model_Mapper_Abstract
{
	/**
     * Retourne un objet selon son Adresse
     * @param string $adresse
     * @throws Exception
     * @return Application_Model_Object_Rubrique
     */
	public function findByAdresse($adresse)
	{
		$row = $this->getDbTable()->fetchRow('rub_adresse = \''.$adresse.'\'');
		
		if (!$row) {
			throw new Exception("Could not find row $adresse");
		}

		return new $this->_object($row->toArray());
	}
}