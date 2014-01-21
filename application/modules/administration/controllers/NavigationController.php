<?php
/**
 * Controleurs de la partie Administration
 */
/**
 * Controleur de l'affichage du menu de la partie d'administration.
 * @package DMFI\Administration\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class Administration_NavigationController extends Zend_Controller_Action
{
	/**
	 * Affichage du menu d'administration
	 * 
	 * Les items du menu sont gérés par le service Administration_Service_Navigation.
	 * Les droits d'accès sont gérés par le service Administration_Service_Acl.
	 * Controlle de la présence de l'objet 'Utilisateur' en session, preuve de la bonne connexion, 
	 * sinon redirection vers la page d'identification.
	 */
    public function indexAction()
    {
        $uti = Application_Service_Session::get('Utilisateur');
        $controllerName = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
        $actionName = Zend_Controller_Front::getInstance()->getRequest()->getActionName();

        if (!$uti && $controllerName != 'login') {
        	$this->_redirect('/administration/login');
        }
        
    	$roleLibelle = 'Defaut';
    	
		if ($uti) {
			$roleLibelle = $uti->getProfile()->getLibelle();
		}
		
        $nav = new Administration_Service_Navigation();
    	$acl = new Administration_Service_Acl();
    	
    	// Vérification des droits
    	if ($controllerName!='index' 
    		and !($controllerName=='utilisateur' and $actionName=='editer') 
    		and !$acl->getAcl()->isAllowed($roleLibelle, $controllerName)) {
    		$this->_redirect('/administration');
    	}
    	
    	$page = $nav->getNavigation()->findOneBy('Controller', $controllerName);
		if ( $page ) {
		  $page->setActive();
		}
    		
		$this->view->navigation($nav->getNavigation());
		$this->view->utilisateur = $uti;
		$this->view->navigation()->setAcl($acl->getAcl())->setRole($roleLibelle);
    }


}

