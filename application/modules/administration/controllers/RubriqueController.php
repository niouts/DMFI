<?php
/**
 * Controleurs de la partie Administration
 */
/**
 * Controleur de l'affichage de gestion des pages d'acceuil des rubriques.
 * @package DMFI\Administration\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class Administration_RubriqueController extends Zend_Controller_Action
{

    /**
     * Affichage de la liste des rubriques
     */
    public function indexAction()
    {
        $this->view->headScript()->appendFile('/js/administration/rubrique/index.js');
        $this->view->headLink()->appendStylesheet('/css/administration/rubrique/index.css');
        
        $aRubriques = Application_Model_Object_Rubrique::all();
        
        $this->view->aRubriques = $aRubriques;
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
    }

    /**
     * Edition de la rubrique dont l'id est posté.
     *
     * Création du répertoire de la rubrique afin de stocker les documents attaché au contenu de la page d'accueil
     * (s'il n'exite pas) dans le dossier /documents/rubrique/$id.
     * Après la sauvegarde, redirection vers la liste principale.
     */
    public function editerAction()
    {
        $this->view->headLink()->appendStylesheet('/css/administration/rubrique/editer.css');
        $this->view->headScript()->appendFile('/js/library/tiny_mce/tiny_mce.js');
        $this->view->headScript()->appendFile('/js/administration/rubrique/editer.js');
        
        $id = $this->_getParam('id', false);
        $rubrique = Application_Model_Object_Rubrique::find($id);
        
        if (! $id) {
            $this->_helper->FlashMessenger('Sélectionnez une rubrique ... ');
            $this->_redirect('/administration/rubrique');
        }
        
        $form = new Administration_Form_Rubrique();
        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
            $values = $form->getValues();
            $rubrique = new Application_Model_Object_Rubrique($values);
            $rubrique->save();

            if ($id)
                $this->_helper->FlashMessenger('La rubrique a été modifiée ... ');
            else
                $this->_helper->FlashMessenger('La rubrique a été créée ... ');
            $this->_redirect('/administration/rubrique');
        }
        
        if (! $this->getRequest()->isPost()) {
            $form->populate($rubrique->toArray());
        }
        
        $fmFldr = "rubrique/" . $rubrique->getId();
        if (! is_dir("documents/file/" . $fmFldr)) {
            mkdir("documents/file/" . $fmFldr, 0755, true);
        }
        if (! is_dir("documents/image/" . $fmFldr)) {
            mkdir("documents/image/" . $fmFldr, 0755, true);
        }
        if (! is_dir("documents/media/" . $fmFldr)) {
            mkdir("documents/media/" . $fmFldr, 0755, true);
        }
        
        $this->view->FMfldr = $fmFldr;
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
        $this->view->form = $form;
    }
}



