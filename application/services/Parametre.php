<?php
/**
 * Services
 */
/**
 * Définition du service des paramètres 
 * @package DMFI\Service
 * @author GFI
 */
class Application_Service_Parametre
{

    /**
     * Récupération de l'ensemble des paramètres et mise en forme 
     * @return string[]
     */
    public static function getAll()
    {
        $aParams = array();
        $aParametres = Application_Model_Object_Parametre::all();
        foreach ($aParametres as $param) {
            $aParams[$param->getCode()] = $param->getValeur();
        }
        return $aParams;
    }
}