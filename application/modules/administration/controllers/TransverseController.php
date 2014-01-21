<?php
/**
 * Controleurs de la partie Administration
 */
/**
 * Controleur de l'affichage de gestion des articles transverses
 * @package DMFI\Administration\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class Administration_TransverseController extends Zend_Controller_Action
{
	/**
	 * Affichage de la liste des articles transverses
	 */
    public function indexAction()
    {
        $this->view->headScript()->appendFile('/js/administration/transverse/index.js');
        $this->view->headLink()->appendStylesheet('/css/administration/transverse/index.css');
                                
        $aArticles = Application_Model_Object_Article::all('art_transverse = 1');
                                                
        $this->view->aArticles = $aArticles;
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
    }

    /**
	 * Suppression de l'article transverse dont l'id est posté.
	 */
    public function supprimerAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $id = $this->_getParam('id', false);
                            	
        if ($id > 0) {
	        $obj = Application_Model_Object_Article::find($id);
	        $obj->delete();
	                                	
	        $this->_helper->FlashMessenger("L'article a bien été supprimé");			
	        $this->_redirect('/administration/transverse');
        }
    }

    /**
	 * Edition de l'article transverse dont l'id est posté.
	 *
	 * Après la sauvegarde, redirection vers la liste principale.
	 */
    public function editerAction()
    {
       	$this->view->headLink()->appendStylesheet('/css/administration/transverse/editer.css');
    	
    	$id = $this->_getParam('id', false);
		
    	if ($id) {
    		$titre = 'Modifier un article transverse';  
    	} else {
    		$titre = 'Ajouter un article transverse';  	
    	}
    	
    	$form = new Administration_Form_Transverse();
		
		if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
        	$values = $form->getValues();
        	
         	$art = new Application_Model_Object_Article($values);
			$art->setUti_id(Application_Service_Session::get('Utilisateur')->getId());
        	
			//Dates de création et modification
        	if (!$id) {
        		$art->setCreation_dt(date('Y-m-d'));
        	} else {
        		$art->setMaj_dt(date('Y-m-d'));
        	}
        	
        	$art->setSrub_id(null);
        	$art->setTransverse(1);
        	$art->setContenu('');
        	
        	$art->save();
			
	        if($id)
				$this->_helper->FlashMessenger('L\'article a été modifié ... ');
	        else
				$this->_helper->FlashMessenger('L\'article a été créé ... ');
			
			$this->_redirect('/administration/transverse');        	
        }
        
        if ($id and !$this->getRequest()->isPost()) {
			$form->populate(Application_Model_Object_Article::find($id)->toArray());
        }
        
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
		$this->view->form = $form;
		$this->view->titre = $titre;
    }


}





