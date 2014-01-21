<?php
/**
 * Services
 */
/**
 * D�finition du service des param�tres 
 * @package DMFI\Service
 * @author GFI
 */
class Application_Service_Parametre
{

    /**
     * R�cup�ration de l'ensemble des param�tres et mise en forme 
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