<?php
/**
 * Controleurs de la partie Administration
 */
/**
 * Controleur de l'affichage de la page d'identification.
 * @package DMFI\Administration\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class Administration_LoginController extends Zend_Controller_Action
{
	/**
	 * Affichager du formulaire d'identification.
	 * 
	 * Si l'utilisateur est correctement identifié via le service Administration_Service_Auth, 
	 * on le redirige vers la liste des articles 
	 * et l'objet Application_Model_Object_Utilisateur est mis en session sous le nom 'Utilisateur'.
	 * Sinon on réaffiche le formulaire.
	 */
    public function indexAction()
    {
    	$this->view->headTitle('Identification');
        $this->view->headLink()->appendStylesheet('/css/administration/login/login.css');
        
        $form = new Administration_Form_Login();
        $auth = new Administration_Service_Auth();
        
        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
        	$uti = $auth->Identifier(
                $this->getRequest()->getParam('cnx_login'), 
        	    $this->getRequest()->getParam('cnx_password')
            );
	        
        	if ($uti) {
        		Application_Service_Session::set('Utilisateur', $uti);
        		$this->_redirect('/administration/article');
        	} else {
        		$this->_helper->FlashMessenger('Impossible de vous authentifier ... ');
        		$this->_redirect('/administration/login');
        	}
        }
        
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
        $this->view->form = $form;
    }

    /**
     * Déconnexion de l'utilisateur
     * 
     * Suppression de l'objet 'Utilisateur' en session et redirection vers la racine du site.
     */
    public function deconnexionAction()
    {
    	$this->_helper->layout->disableLayout();
    	Application_Service_Session::remove('Utilisateur');
    	$this->_redirect('/');
    }


}

