<?php 
/**
 * Validate
 */
/**
 * Définition du validate Uri
 * @package DMFI\Library\Tools\Validate
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Validate_Abstract.html
 * Zend_Validate_Abstract
 */
class Tools_Validate_Uri extends Zend_Validate_Abstract
{
    const BAD_URI = 'badUri';

     /**
	 * @var array $_messageTemplates templates des messages d'erreurs
	 */
	protected $_messageTemplates = array(
        self::BAD_URI => "'%value%' n'est pas une adresse valide"
    );

    /**
	 * Vérification de la validité du champ
	 * @param  mixed $value
     * @return boolean
     * @link http://framework.zend.com/apidoc/1.10/_Validate_Interface.html#Zend_Validate_Interface::isValid()
     * Zend_Validate_Interface::isValid()
	 */
    public function isValid($value)
    {
        $this->_setValue($value);

        if (!Zend_Uri::check($value)) {
            $this->_error(self::BAD_URI);
            return false;
        }

        return true;
    }   
}