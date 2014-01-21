<?php
/**
 * Formulaires
 */
/**
 * Définition du formulaire login
 * @package DMFI\Administration\Form
 * @author GFI
 */
class Administration_Form_Login extends Administration_Form_Abstract
{
	/**
	 * Initialisation du formulaire
	 * @link http://framework.zend.com/apidoc/1.10/_Form.html#Zend_Form::init()
     * Zend_Form::init()
	 */
	public function init()
	{
		//Definition du formulaire
		$this->setAction('')
			 ->setMethod('post')
			 ->setAttrib('id', 'login_form');
		
		$this->setModeAffichage(Administration_Form_Abstract::MODE_DIV);
			 
		$login = $this->createElement('text', 'cnx_login', array('label' => 'Votre identifiant', 'size'=>35));
		$login->setRequired(true);		
		$this->addElement($login);
		
		$pwd = $this->createElement('password', 'cnx_password', array('label' => 'Votre mot de passe', 'size'=>35));
		$pwd->setRequired(true);		
		$this->addElement($pwd);
		
		// addElement() agit comme une fabrique qui crée un bouton 'Login'
     	$this->addElement('submit', 'valider', array('label' => 'valider'));
		
     	
     	
	}
	
}

