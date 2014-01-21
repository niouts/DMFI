<?php
/**
 * Services
 */
/**
 * D�finition du service de session 
 * @package DMFI\Service
 * @author GFI
 */
class Application_Service_Session
{
    /**
     *
     * @var Zend_Session_Namespace instance de la classe
     */
    private static $_session = null;

    /**
     * R�cup�ration de l'instance de l'objet      
     * @return Zend_Session_Namespace $_session
     */
    public static function getInstance()
    {
        if (is_null(self::$_session)) {
            self::$_session = new Zend_Session_Namespace('dmfi');
        }
        return self::$_session;
    }

    /**
     * Constructeur
     */
    private function __construct()
    {
    	
    }

    /**
     * Affectation d'une variable en session      
     * @param string $name
     * @param mixed $data
     */
    public static function set($name, $data)
    {
        self::getInstance()->$name = $data;
    }

    /**
     * R�cup�ration d'une variable en session    
     * @param string $attr
     * @param bool $writable
     * @return mixed
     */
    public static function get($attr, $writable = false)
    {
        if (! $writable and is_object(self::getInstance()->$attr))
            return clone (self::getInstance()->$attr);
        else
            return self::getInstance()->$attr;
    }

    /**
     * R�cup�ration de l'ensemble de la session sous forme d'un tableau     
     * @return array
     */
    public static function toArray()
    {
        $a = array();
        foreach (self::getInstance() as $attr => $value) {
            $a[$attr] = $value;
        }
        return $a;
    }

    /**
     * Suppression d'un �l�ment      
     * @param string $attr
     */
    public static function remove($attr)
    {
        unset(self::getInstance()->$attr);
    }
}