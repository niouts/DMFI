<?php 
/**
 * Validate
 */
/**
 * Définition du validate LocaleUri
 * @package DMFI\Library\Tools\Validate
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Validate_Abstract.html
 * Zend_Validate_Abstract
 */
class Tools_Validate_LocaleUri extends Zend_Validate_Abstract
{
    const BAD_LOCALE_URI = 'badLocaleUri';

    /**
	 * @var array $_messageTemplates templates des messages d'erreurs
	 */
	protected $_messageTemplates = array(
        self::BAD_LOCALE_URI => "n'est pas une adresse valide"
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

        if (!preg_match('#^[0-9A-Za-z_-]*$#', $value)) {
            $this->_error(self::BAD_LOCALE_URI);
            return false;
        }

        return true;
    }
}