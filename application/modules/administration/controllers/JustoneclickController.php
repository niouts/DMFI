<?php
/**
 * Controleurs de la partie Administration
 */
/**
 * Controleur de l'affichage de gestion des liens JustOneClick
 * @package DMFI\Administration\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class Administration_JustoneclickController extends Zend_Controller_Action
{
	/**
	 * Affichage de la liste des liens
	 */
    public function indexAction()
    {
        $this->view->headScript()->appendFile('/js/administration/justoneclick/index.js');
		$this->view->headLink()->appendStylesheet('/css/administration/justoneclick/index.css');
        		
		$aJoc = Application_Model_Object_JustOneClick::all(null, 'joc_ordre asc');
                        
		$this->view->aJoc = $aJoc;
		$this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
    }

    /**
	 * Edition du lien dont l'id est posté.	  
	 * Après la sauvegarde, redirection vers la liste principale
	 */
    public function editerAction()
    {
    	$this->view->headScript()->appendFile('/js/administration/justoneclick/editer.js');
    	$this->view->headLink()->appendStylesheet('/css/administration/justoneclick/editer.css');
    	
		$id = $this->_getParam('id', false);
		if ($id) {
    		$titre = 'Modifier un lien';  
    	} else {
    		$titre = 'Ajouter un lien';  	
    	}
    	
    	$form = new Administration_Form_Justoneclick();
		
		if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
        	$values = $form->getValues();

			$joc = new Application_Model_Object_JustOneClick($values);
			$joc->save();
						
	        if ($id) {
				$this->_helper->FlashMessenger('Le lien a été modifié ... ');
	        } else {
				$this->_helper->FlashMessenger('Le lien a été créé ... ');
	        }
			
			$this->_redirect('/administration/justoneclick');
        }
        
   		if ($id and !$this->getRequest()->isPost()) {
   			
   			$params = Application_Model_Object_JustOneClick::find($id)->toArray();
			$form->populate($params);
        }
        
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
		$this->view->form = $form;
		$this->view->titre = $titre;
    }
    
    /**
     * Changement de l'ordre du lien. 
     * Changement de l'ordre suivant la flèche cliquée dans la liste via un appel ajax.
     * Retourne (affiche) 'ok' si le traitement c'est bien passé, 'fin' sinon.
     */
    public function changerordreAction()
    {
    	$this->_helper->layout->disableLayout();
    	
        $action = $this->_request->getParam('bouger');
        $id 	= (int)$this->_request->getParam('id');

        $selected = Application_Model_Object_JustOneClick::find($id);

        if ( $selected->getOrdre() == 1 && $action=='monter') {
        	exit();
        }
        
        if ($action == 'monter') {
        	$newOrdre = $selected->getOrdre()-1;
        	$next = Application_Model_Object_JustOneClick::find('joc_ordre = '.$newOrdre);
        } else {
        	$newOrdre = $selected->getOrdre()+1;
        	$next = Application_Model_Object_JustOneClick::find('joc_ordre = '.$newOrdre);
        }

        if ($next) {
	        $next->setOrdre($selected->getOrdre());
	        $next->save();
	        $selected->setOrdre($newOrdre);
	        $selected->save();
	        echo 'ok';
	        exit();
        }

        echo 'fin';
    }

    /**
	 * Suppression du lien dont l'id est posté.
	 */
	public function supprimerAction()
    {
        $this->_helper->viewRenderer->setNoRender();
		$id = $this->_getParam('id', false);
            	
        if ($id>0) {
        	$obj = Application_Model_Object_JustOneClick::find($id);
            $obj->delete();
                	
            $this->_helper->FlashMessenger("Le lien a bien été supprimé");			
        	$this->_redirect('/administration/justoneclick');
        }
    }

}



