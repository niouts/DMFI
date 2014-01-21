<?php
/**
 * Formulaires
 */
/**
 * Définition du formulaire just one click
 * @package DMFI\Administration\Form
 * @author GFI
 */
class Administration_Form_Justoneclick extends Administration_Form_Abstract
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
			 ->setAttrib('id', 'justoneclick_form');
		
		$this->setModeAffichage(Administration_Form_Abstract::MODE_DIV);

		$id = $this->createElement('hidden', 'id', array('value'=>0));
		$this->addElement($id);

		$ordre = $this->createElement(
		    'hidden', 
		    'ordre', 
		    array('value'=>Application_Model_Mapper_JustOneClick::getOrdreMax()+1)
		);
		$this->addElement($ordre);
		
		$libelle = $this->createElement('text', 'libelle', array('label' => 'libellé', 'size'=>35));
		$libelle->setRequired(true);		
		$this->addElement($libelle);
		
		$adresse = $this->createElement('text', 'lien', array('label' => 'adresse', 'size'=>35));
		$adresse->setRequired(true);		
		$this->addElement($adresse);
				
		$this->addElement('button', 'annuler', array('label' => 'annuler','class'=>'annuler','position'=>'deb'));
		$this->addElement('submit', 'valider', array('label' => 'valider','position'=>'fin'));
     	
	}
	
}

