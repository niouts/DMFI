<?php
/**
 * Formulaires
 */
/**
 * Définition du formulaire utilisateur
 * @package DMFI\Administration\Form
 * @author GFI
 */
class Administration_Form_Utilisateur extends Administration_Form_Abstract
{
	/**
	 * Initialisation du formulaire
	 * @link http://framework.zend.com/apidoc/1.10/_Form.html#Zend_Form::init()
     * Zend_Form::init()
	 */
	public function init()
	{
		$utilisateur = Application_Service_Session::get('Utilisateur');
		
		//Definition du formulaire
		$this->setAction('')
			 ->setMethod('post')
			 ->setAttrib('id', 'utilisateur_form');
		
		$this->setModeAffichage(Administration_Form_Abstract::MODE_DIV);

		$id = $this->createElement('hidden', 'id', array('value' => 0));
		$this->addElement($id);
		$pwd = $this->createElement('hidden', 'pwd');
		$this->addElement($pwd);
		
		$nom = $this->createElement('text', 'nom', array('label' => 'nom', 'size'=>35));
		$nom->setRequired(true);		
		$this->addElement($nom);
		
		$prenom = $this->createElement('text', 'prenom', array('label' => 'prénom', 'size'=>35));
		$prenom->setRequired(true);		
		$this->addElement($prenom);
		
		$mel = $this->createElement('text', 'mail', array('label' => 'adresse mel', 'size'=>35));
		$mel->addValidator('EmailAddress');
		$this->addElement($mel);
		
		$login = $this->createElement(
		    'text', 
		    'login', 
		    array('label' => 'identifiant', 'size'=>35, 'autocomplete'=>'off')
		);
		$login->setRequired(true);	
		$this->addElement($login);
		
		
		if ($utilisateur->getProfile()->getLibelle() == 'Administrateur') {
			$profile = $this->createElement('select', 'pro_id', array('style'=>'width:230px'));
			$profile->setLabel('profile ');
			$profile->setRequired(true);
			
			$aProfiles = Application_Model_Object_Profile::all();
			foreach ($aProfiles as $pro) {
				$profile->addMultiOption($pro->getId(), $pro->getLibelle(), array('selected' => true));
			}
			$profile->setValue(array('1'));
			$this->addElement($profile);
		} else {
			$id = $this->createElement('hidden', 'pro_id', array('value' => $utilisateur->getPro_id()));
			$this->addElement($id);
		}
		
		$pwd = $this->createElement('password', 'pwd1', array('label' => 'nouveau mot de passe', 'size'=>35));	
		$this->addElement($pwd);
		
		$pwd = $this->createElement(
		    'password', 
		    'pwd2', 
		    array('label' => 'confirmer le nouveau mot de passe', 'size'=>35)
		);	
		$this->addElement($pwd);
		
		if ($utilisateur->getProfile()->getLibelle() == 'Administrateur') {
			$afficher = array();
		} else {
			$afficher = array('readonly'=>'readonly','onclick'=>'return false;');
		}
		
		$rubriques = $this->createElement('MultiCheckbox', 'rub_id' ,$afficher);
		$rubriques->setLabel('rubriques ');
		
		$aRubriques = Application_Model_Object_Rubrique::all();
		foreach ($aRubriques as $rub) {
			$rubriques->addMultiOption($rub->getId(), $rub->getLibelle());
		}
		$this->addElement($rubriques);
		
		
		$this->addElement('button', 'annuler', array('label' => 'annuler','class'=>'annuler','position'=>'deb'));
		$this->addElement('submit', 'valider', array('label' => 'valider','position'=>'fin'));
     	
     	
	}
	
}

