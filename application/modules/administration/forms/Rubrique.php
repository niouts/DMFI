<?php
/**
 * Formulaires
 */
/**
 * Définition du formulaire rubrique
 * @package DMFI\Administration\Form
 * @author GFI
 */
class Administration_Form_Rubrique extends Administration_Form_Abstract
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
			 ->setAttrib('id', 'rubrique_form');
		
		$this->setModeAffichage(Administration_Form_Abstract::MODE_DIV);

		$id = $this->createElement('hidden', 'id');
		$this->addElement($id);
		
		$libelle = $this->createElement('text', 'libelle', array('label' => 'libellé', 'size'=>35, 'readonly'=>true));	
		$this->addElement($libelle);
		
		$adresse = $this->createElement('hidden', 'adresse', array('label' => 'adresse'));	
		$this->addElement($adresse);
		
		$contenu = $this->createElement('textarea', 'accueil', array('label' => 'page d\'accueil'));
		$contenu->setRequired(true);		
		$this->addElement($contenu);

		$this->addElement('button', 'annuler', array('label' => 'annuler','class' => 'annuler','position'=>'deb'));
		$this->addElement('submit', 'valider', array('label' => 'valider','position' => 'fin'));
	}
	
}

