<?php
/**
 * Filtres
 */
/**
 * Définition du filtre de date
 * @package DMFI\Library\Tools\Filter
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Filter_Interface.html
 * Zend_Filter_Interface
 */
class Tools_Filter_LocalDateToMysql implements Zend_Filter_Interface
{
    /**
     * Retourne le résultat du filtre
     * @param  mixed $value
     * @return mixed
     * @link http://framework.zend.com/apidoc/1.10/_Filter_Interface.html#Zend_Filter_Interface::filter()
     * Zend_Filter_Interface::filter()
     */   
	public function filter($value)
    {
        if (Zend_Date::isDate($value, Zend_Date::DATE_SHORT)) {
            // La valeur correspond bien à une date au format local court
            // On crée un objet date ...
            $date = new Zend_Date($value, Zend_Date::DATE_SHORT);
            // ... et on le convertit au format MySQL
            return $date->toString(Tools_Date::MYSQL_DATE);
        }
        return $value;   
    }
}