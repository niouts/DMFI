<?php
/**
 * Formulaires
 */
/**
 * Définition du formulaire parametre
 * @package DMFI\Administration\Form
 * @author GFI
 */
class Administration_Form_Parametre extends Administration_Form_Abstract
{
	/**
	 * @var string bloc
	 */
	private $_bloc;
	
	/**
	 * Constructeur du formulaire
	 * @param mixed $options
	 * @param string $bloc
	 * @see Administration_Form_Abstract::__construct()
     */
	public function __construct($options = null, $bloc='')
	{
		$this->_bloc = $bloc;
		parent::__construct($options);
	}
	
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
			 ->setAttrib('id', 'parametre_form');
		
		$this->setModeAffichage(Administration_Form_Abstract::MODE_DIV);

		$id = $this->createElement('hidden', 'id', array('value' => 0));
		$this->addElement($id);
		$bloc = $this->createElement('hidden', 'bloc', array('value' => $this->_bloc));
		$this->addElement($bloc);
		
		$code = $this->createElement('text', 'code', array('label' => 'nom', 'size'=>35, 'readonly'=>true));	
		$this->addElement($code);
		
		$contenu = $this->createElement('textarea', 'valeur', array('label' => 'valeur'));
		$contenu->setRequired(true);		
		$this->addElement($contenu);

		$this->addElement('button', 'annuler', array('label' => 'annuler','class'=>'annuler','position'=>'deb'));
		$this->addElement('submit', 'valider', array('label' => 'valider','position'=>'fin'));
	}
	
}

