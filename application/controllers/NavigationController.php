<?php
/**
 * Controleurs de la partie Front office
 */
/**
 * Controleur de l'affichage du menu de navigation.
 * @package DMFI\FrontOffice\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class NavigationController extends Zend_Controller_Action
{
	/**
	 * Affichage du menu et récupération de la page en cours.
	 */
    public function indexAction()
    {
    	$request = new Zend_Controller_Request_Http();
		$uri = $request->getPathInfo();

    	$aRubriques = Application_Model_Object_Rubrique::all();

        $this->view->aRubriques = $aRubriques;
        $this->view->uri = $uri;
    }


}

