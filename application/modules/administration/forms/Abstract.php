<?php
/**
 * Formulaires
 */
/**
 * Définition de la classe abstraite
 * @package DMFI\Administration\Form
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Form.html
 * Zend_Form
 */
class Administration_Form_Abstract extends Zend_Form
{
	/**
	 * @var array _decoTableau affichage pour le mode tableau
	 */
	protected $_decoTableau = 
			array('Form'=>	array('FormElements',
								array('HtmlTag', array('tag' => 'table','class'=>'Form','align'=>'center')),'Form'),
				  	'Element'=>array(	'Description'=>array('tag' => '', 'class' => 'description'),
									 	'HtmlTag'=> array('tag' => 'td'),
										'Label'=>array('tag' => 'th'),
										'Autre'=>array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
								),
			'jQuery' =>array('UiWidgetElement','Errors',
					    array('Description', array('tag' => '', 'class' => 'description')),
								array('HtmlTag', array('tag' => 'td')),
								array('Label', array('tag' => 'th')),
								array(array('tr' => 'HtmlTag'), array('tag' => 'tr')) 
					),
			'Submit'=> array('ViewHelper',
								array(array('td' => 'HtmlTag'), 
								array('tag' => 'td', 'colspan' => 2)),
								array(array('tr' => 'HtmlTag'), 
								array('tag' => 'tr'))) 
			);
	
	/**
	 * @var array _decoDiv affichage pour le mode div
	 */
	protected $_decoDiv = 
		array(
			'Form'=> array('FormElements',
							array('HtmlTag',array('tag' => 'div','class'=>'Form')),'Form'),
			'Element'=>array(	'Description'=>array('tag' => 'p', 'class' => 'description'),
								 	'HtmlTag'=> array('tag' => 'div'/*,'class'=>''*/),
									'Label'=>array('tag' => 'div'),
									'Autre'=>array(array('div' => 'HtmlTag'), array('tag' => 'div','class'=>'ligne'))
								),
			'jQuery' =>array('UiWidgetElement','Errors',
					    array('Description', array('tag' => 'p', 'class' => 'description')),
					    array('HtmlTag', array('tag' => 'div','class'=>'Droite')),
					    array('Label', array('tag' => 'div','class'=>'Gauche')),
					    array(array('div' => 'HtmlTag'), array('tag' => 'div','class'=>'ligne'))
					),
			'Submit' => array('ViewHelper',
							array('HtmlTag', array('tag' => 'div','class'=>'submit'))),
			'Bouton_deb' => array('ViewHelper',
							array('HtmlTag', array('tag' => 'div','class'=>'submit','openOnly' => true))),
			'Bouton_fin' => array('ViewHelper',
							array('HtmlTag', array('tag' => 'div','class'=>'submit','closeOnly' => true)))	
							
				);	

	/**
	 * @var string _modeAffichage MODE_TABLEAU | MODE_DIV
	 */
	protected $_modeAffichage;		

	const MODE_TABLEAU 	= 'Tableau';
	const MODE_DIV		= 'Div';
	
	
	/**
	 * Récupération du mode d'affichage
	 * @return string _modeAffichage MODE_TABLEAU | MODE_DIV
	 */
	public function getModeAffichage() 
	{
		return $this->_modeAffichage;
	}

	/**
	 * Affectation du mode d'affichage
	 * @param string modeAffichage MODE_TABLEAU | MODE_DIV
	 */
	public function setModeAffichage($modeAffichage) 
	{
		$this->_modeAffichage = $modeAffichage;
	}

	/**
	 * Récupération du décorateur en fonction du mode d'affichage
	 * @return array
	 */
	public function getDecorateur()
	{
		if($this->_modeAffichage == self::MODE_TABLEAU)
			return $this->_decoTableau;
		else
			return $this->_decoDiv;
	}
	
	/**
	 * Initialisation
	 * @param mixed $options
     * @link http://framework.zend.com/apidoc/1.10/_Form.html#Zend_Form::__construct()
     * Zend_Form::__construct()
	 */
	public function __construct($options = null)
	{
		parent::__construct($options);
		// traduction des messages d'erreur de validation
        $french = array(
	        'notAlnum'=>' %value% ne contient pas que des lettres et/ou des chiffres.',
			'notAlpha'=>' %value% ne contient pas que des lettres.',
			'notBetween'=>' %value% nest pas compris entre %min% et %max% inclus.',
			'notBetweenStrict'=>' %value% nest pas compris entre %min% et %max% exclus.',
			'dateNotYYYY-MM-DD'=>' %value% nest pas une date au format AAAA-MM-JJ (exemple : 2000-12-31).',
			'dateInvalid'=>' %value% nest pas une date valide.',
			'dateFalseFormat'=>' %value% nest pas une date valide au format JJ/MM/AAAA (exemple : 31/12/2000).',
			'notDigits'=>' %value% ne contient pas que des chiffres.',
			'emailAddressInvalidFormat'=>' %value% n\'est pas une adresse mel valide.',
			'emailAddressInvalidHostname'=>' %hostname% n\'est pas un domaine valide pour l adresse mel %value%.',
			'emailAddressInvalidMxRecord'=>' %hostname% n\'accepte pas l adresse mel %value%.',
			'emailAddressDotAtom'=>' %localPart% ne respecte pas le format dot-atom.',
			'emailAddressQuotedString'=>' %localPart% ne respecte pas le format quoted-string.',
			'emailAddressInvalidLocalPart'=>' %localPart% n\'est pas une adresse individuelle valide.',
			'notFloat'=>' %value% n\'est pas un nombre décimal.',
			'notGreaterThan'=>' %value% n\'est pas strictement supérieur à  %min%.',
			'notInt'=>' %value% n\'est pas un nombre entier.',
			'notLessThan'=>' %value% n\'est pas strictement inférieur à  %max%.',
			'isEmpty'=>' Ce champ est obligatoire.',
			'stringEmpty'=>' Ce champ est obligatoire.',
			'regexNotMatch'=>' %value% ne respecte pas le format %pattern%.',
			'stringLengthTooShort'=>' %value% fait moins de %min% caractères.',
			'stringLengthTooLong'=>' %value% fait plus de %max% caractères.'
        );
 
        $translate = new Zend_Translate('array', $french, 'fr');
        $this->setTranslator($translate);
	}
	
	/**
     * Render form
     *
     * @param  Zend_View_Interface $view
     * @return string
     */
    public function render(Zend_View_Interface $view = null)
	{
		$deco = $this->getDecorateur();

		$this->setDecorators($deco['Form']);
		
		foreach ($this->getElements() as $element) { 
			switch ($element->helper)
			{
				case 'formHidden':
					$element->removeDecorator('HtmlTag');
					$element->removeDecorator('Label');
				    break;
								
				case 'formSubmit':
				case 'formButton':
					if($element->position)
						$element->setDecorators($deco['Bouton_'.$element->position]);
					else	
						$element->setDecorators($deco['Submit']);
				    break;
				
				default :
					foreach ($element->getDecorators() as $type => $d) {
						$t = '';
						switch ($type)
						{
							case 'Zend_Form_Decorator_HtmlTag':
								$t = 'HtmlTag';
                                break;
							
							case 'Zend_Form_Decorator_Label':
								$t = 'Label';
							    break;
							
							case 'Zend_Form_Decorator_Description':
								$t = 'Description';
							    break;
												
						}
						
						if ($t) {
							foreach ($deco['Element'][$t] as $k=>$v) {
								$d->setOption($k, $v);
							}
						}
						
						$element->addDecorator($deco['Element']['Autre'][0], $deco['Element']['Autre'][1]);
						
					}
					
				    break;
			}
			
		}
		return parent::render($view);
	}
		
		
}