<?php
/**
 * Formulaires
 */
/**
 * D�finition du formulaire article (nouveau)
 * @package DMFI\Administration\Form
 * @author GFI
 */
class Administration_Form_NouvelArticle extends Administration_Form_Abstract
{
	/**
	 * Initialisation du formulaire
	 * @link http://framework.zend.com/apidoc/1.10/_Form.html#Zend_Form::init()
     * Zend_Form::init()
	 */
	public function init()
	{
		$this->addElementPrefixPath('Tools_Filter', 'Tools/Filter', Zend_Form_Element::FILTER);
		$this->addElementPrefixPath('Tools_Validate', 'Tools/Validate', Zend_Form_Element::VALIDATE);
		
		//Definition du formulaire
		$this->setAction('')
			 ->setMethod('post')
			 ->setAttrib('id', 'article_form');
		
		$this->setModeAffichage(Administration_Form_Abstract::MODE_DIV);

		$sousRubrique = $this->createElement('select', 'srub_id');
		$sousRubrique->setLabel('sous-rubrique ');
		$sousRubrique->setRequired(true);
		
		$aSousRubriques = Administration_Service_SousRubrique::getListeSousRubriques();
		foreach ($aSousRubriques as $srub) {
			$sousRubrique->addMultiOption($srub->getId(), $srub->getRubrique()->getLibelle().' > '.$srub->getLibelle());
		}
		$this->addElement($sousRubrique);
		
		$titre = $this->createElement('text', 'titre', array('label' => 'titre','size' => 120));
		$titre->setRequired(true);		
		$this->addElement($titre);
		
		$adresse = $this->createElement('text', 'adresse', array('label' => 'adresse', 'size' => 120));
		$adresse->setRequired(true);		
		$adresse->setValidators(array('LocaleUri'));
		$this->addElement($adresse);
		
		$creation = $this->createElement('hidden', 'creation_dt', array('label' => 'date de cr�ation'));
		$this->addElement($creation);
		
		$transverse = $this->createElement('hidden', 'transverse', array('label' => 'transverse', 'value' => 0));
		$this->addElement($transverse);
		
		$utilisateur = $this->createElement(
		    'hidden', 
		    'uti_id', 
		    array('label' => 'utilisateur', 'value' => Application_Service_Session::get('Utilisateur')->getId())
		);
		$this->addElement($utilisateur);
		
		$this->addElement('button', 'annuler', array('label' => 'annuler','class'=>'annuler','position'=>'deb'));
		$this->addElement('submit', 'valider', array('label' => 'suivant','class'=>'suivant','position'=>'fin'));
     	
	}
	
}

