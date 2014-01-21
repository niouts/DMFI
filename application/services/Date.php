<?php
/**
 * Services
 */
/**
 * Définition du service de date
 * @package DMFI\Service
 * @author GFI
 */
class Application_Service_Date
{

    /**
     * Conversion d'une date MySQL (YYYY-mm-dd) au format dd/mm/YYYY 
     * @param string $date
     * @return string
     */
    public static function mySQLToIHM($date)
    {
        if (is_null($date)) {
            return '&nbsp;';
        }
        list ($annee, $mois, $jour) = explode('-', $date);
        return $jour . '/' . $mois . '/' . $annee;
    }
}
