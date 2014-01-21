<?php
/**
 * Element de formulaire
 */
/**
 * Définition de l'élément Date
 * @package DMFI\Library\Tools\Form\Element
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Form_Element_Text.html
 * Zend_Form_Element_Text
 */
class Tools_Form_Element_Date extends Zend_Form_Element_Text
{
    /**
	 * @var string $helper helper
	 */
	public $helper = 'formDate';

    /**
     * Initialisation de l'élément
     * @link http://framework.zend.com/apidoc/1.10/_Form_Element_Text.html#Zend_Form_Element_Text::init()
     * Zend_Form_Element_Text::init()
     */
    public function init()
    {
        $this->addPrefixPath('Tools_Filter', 'Tools/Filter', Zend_Form_Element::FILTER);
        $this->addFilter('LocalDateToMysql');
        
        $val = new Zend_Validate_Date(Tools_Date::MYSQL_DATE);
        $this->addValidator($val);       
    }
}