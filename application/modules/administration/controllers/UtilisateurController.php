<?php
/**
 * Controleurs de la partie Administration
 */
/**
 * Controleur de l'affichage de gestion des utilisateurs
 * @package DMFI\Administration\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class Administration_UtilisateurController extends Zend_Controller_Action
{

	/**
	 * Affichage de la liste des utilisateurs
	 */
    public function indexAction()
    {
		$this->view->headScript()->appendFile('/js/administration/utilisateur/index.js');
		$this->view->headLink()->appendStylesheet('/css/administration/utilisateur/index.css');

		$aUtilisateurs = Application_Model_Object_Utilisateur::all();
                
        $this->view->aUtilisateurs = $aUtilisateurs;
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
    }

    /**
	 * Edition de l'utilisateur dont l'id est posté.
	 *
	 * Si le profile en cours n'est pas 'administrateur', on vérifie que l'utilisateur edite bien son propre compte.
	 * Sinon on le redirige vers la liste des articles.
	 * Après la sauvegarde, redirection vers la liste principale.
	 */
    public function editerAction()
    {
    	$this->view->headScript()->appendFile('/js/administration/utilisateur/editer.js');
    	$this->view->headLink()->appendStylesheet('/css/administration/utilisateur/editer.css');
    	
		$id = $this->_getParam('id', false);
		if (strtolower(Application_Service_Session::get('Utilisateur')->getProfile()->getLibelle()) != 'administrateur' 
			and $id != Application_Service_Session::get('Utilisateur')->getId() ) {
			$this->_redirect('/administration/article');
		}
		
		$form = new Administration_Form_Utilisateur();
		
		if ($id) {
    		$titre = 'Modifier un utilisateur';  
    	} else {
    		$titre = 'Ajouter un utilisateur';
	    	$form->pwd1->setRequired(true);
    	}
    			
		if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
        	$values = $form->getValues();

        	$uti = new Application_Model_Object_Utilisateur($values);
        	
        	if ($values['pwd1']) {
        		$uti->setPwd($values['pwd1'], true);
        	} else {
        		$uti->setPwd($values['pwd']);
        	}

			$uti->save();
			
        	if ($values['rub_id']) {
	        	if ($values['id']) {
	        		$mUR = new Application_Model_Mapper_UtilisateurRubrique();
	        		$mUR->deleteAll('uti_id = '.$values['id']);
	        	}
	        	
	        	$acces = new Application_Model_DbTable_UtilisateurRubrique();
	        	foreach ($values['rub_id'] as $rubId) {
	        		$acces->insert(array('uti_id'=>$uti->getId(),'rub_id'=>$rubId));
	        	}
        	}
			
	        if ($id) {
				$this->_helper->FlashMessenger('L\'utilisateur a été modifié ... ');
	        } else {
				$this->_helper->FlashMessenger('L\'utilisateur a été créé ... ');
	        }
			
			$this->_redirect('/administration/utilisateur');
        }

   		if ($id and !$this->getRequest()->isPost()) {
   			
   			$uti = Application_Model_Object_Utilisateur::find($id);
   			$params = $uti->toArray();
   			$params['rub_id'] = $uti->getRubriquesId();
   			
			$form->populate($params);
        }
        
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
		$this->view->form = $form;
		$this->view->titre = $titre;
    }
    
    /**
	 * Suppression de l'utilisateur dont l'id est posté.
	 */
    public function supprimerAction()
    {
        $this->_helper->viewRenderer->setNoRender();
		$id = $this->_getParam('id', false);
            	
        if ($id>0) {
        	$obj = Application_Model_Object_Utilisateur::find($id);
            $obj->delete();
                	
            $this->_helper->FlashMessenger("L'utilisateur a bien été supprimé");			
        	$this->_redirect('/administration/utilisateur');
        }
    }
}
