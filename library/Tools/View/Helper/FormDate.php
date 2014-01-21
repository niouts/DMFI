<?php
/**
 * Helper de vue
 */
/**
 * Définition de l'helper 
 * @package DMFI\Library\Tools\View\Helper
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_View_Helper_FormText.html
 * Zend_View_Helper_FormText
 */
class Tools_View_Helper_FormDate extends Zend_View_Helper_FormText
{
    /**
	 * Mise en forme de la date
	 * @param string $name
	 * @param string $value
	 * @param array $attribs
	 * @return string
	 */
	public function formDate($name, $value = '', $attribs = null)
    {
        if (!isset($attribs)) $attribs = array();

        (isset($attribs['class'])) ? $attribs['class'] .= ' date' : $attribs['class'] = 'date';
        
        if (!isset($attribs['maxlength'])) {
            $attribs['maxlength'] = 10; //strlen(Tools_Date::MYSQL_DATE);
        }
        
        if (!isset($attribs['size'])) {
            $attribs['size'] = 10; //strlen(Tools_Date::MYSQL_DATE);
        }

        if (Zend_Date::isDate($value, Tools_Date::MYSQL_DATE)) {
            $date = new Zend_Date($value, Tools_Date::MYSQL_DATE);
            $value = $date->get('dd/MM/yyyy');
        } elseif ($value == '0000-00-00') {
            $value = '';
        }
        return parent::formText($name, $value, $attribs);
    }
}