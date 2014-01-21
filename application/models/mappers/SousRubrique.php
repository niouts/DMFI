<?php
/**
 * mapper des tables
 */
/**
 * mapper de la table T_SOUS_RUBRIQUE
 * @package DMFI\Models\mappers
 * @author GFI
 */
class Application_Model_Mapper_SousRubrique extends Application_Model_Mapper_Abstract
{
	/**
     * Retourne un objet selon son Adresse
     * @param string $adresseRubrique
     * @param string $adresseSousRubrique
     * @throws Exception
     * @return Application_Model_Object_SousRubrique
     */
	public function findByAdresse($adresseRubrique,$adresseSousRubrique)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$row = $db->fetchRow(
		    'SELECT sr.*
			FROM t_sous_rubrique sr
			JOIN t_rubrique r ON r.rub_id = sr.rub_id AND rub_adresse = ?
			WHERE srub_adresse = ?', array($adresseRubrique, $adresseSousRubrique)
		);

		if (!$row) {
			throw new Exception("Could not find row $adresseRubrique/$adresseSousRubrique");
		}

		return new $this->_object($row);
	}
	
	/**
	 * Liste les identifiants des sous rubriques autorisées pour un utilisateur
	 * @param int $id
	 * @return int[]
	 */
	public function findByUtilisateur($id) 
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$liste = $db->fetchAll(
		    'SELECT sr.srub_id 
			FROM t_utilisateur_rubrique ur
			JOIN t_rubrique r ON ur.rub_id = r.rub_id
			JOIN t_sous_rubrique sr ON r.rub_id = sr.rub_id
			WHERE ur.uti_id = ?', array($id)
		);
		
		$aId = array();
		foreach ($liste as $element) {
			$aId[] = $element['srub_id'];	
		}
		
		return $aId;
	}
}