<?php
/**
 * Controleurs de la partie Administration
 */
/**
 * Controleur de l'affichage de gestion des articles
 * @package DMFI\Administration\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class Administration_ArticleController extends Zend_Controller_Action
{

    /**
     * Affichage de la liste des articles
     */
    public function indexAction()
    {
        $this->view->headScript()->appendFile('/js/administration/article/index.js');
        $this->view->headLink()->appendStylesheet('/css/administration/article/index.css');
        $aArticles = Administration_Service_Article::getListeArticles();
        $this->view->aArticles = $aArticles;
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
    }

    /**
     * Suppression de l'article dont l'id est posté.
     */
    public function supprimerAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $id = $this->_getParam('id', false);
        if ($id > 0) {
            Administration_Service_Fichier::removedir('documents/article/' . $id);
            $obj = Application_Model_Object_Article::find($id);
            $obj->delete();
            $this->_helper->FlashMessenger("L'article a bien été supprimé");
            $this->_redirect('/administration/article');
        }
    }

    /**
     * Edition de l'article dont l'id est posté.
     *
     * Après la sauvegarde, redirection vers la liste principale
     */
    public function editerAction()
    {
        $this->view->headScript()->appendFile('/js/library/tiny_mce/tiny_mce.js');
        $this->view->headScript()->appendFile('/js/administration/article/editer.js');
        $this->view->headLink()->appendStylesheet('/css/administration/article/editer.css');
        $id = $this->_getParam('id', false);
        if ($id) {
            $form = new Administration_Form_Article();
            $art = Application_Model_Object_Article::find($id);
            $titre = 'Modifier un article';
        } else {
            $form = new Administration_Form_NouvelArticle();
            $art = new Application_Model_Object_Article();
            $titre = 'Ajouter un article';
        }
        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
            $values = $form->getValues();
            // Vérification unicité de l'adresse
            $mapper = new Application_Model_Mapper_Article();
            $unicite = $mapper->adresseIsUnique($values['adresse'], $values['srub_id'], $id);
            if (! $unicite) {
                $form->getElement('adresse')->addError('L\'adresse n\'est pas unique pour cette sous rubrique');
            } else {
                $art = new Application_Model_Object_Article($values);
                // Dates de création et modification
                if (! $id) {
                    $art->setCreation_dt(date('Y-m-d'));
                } else {
                    $art->setMaj_dt(date('Y-m-d'));
                }
                $art->save();
                if ($id) {
                    $this->_helper->FlashMessenger('L\'article a été modifié ... ');
                    $this->_redirect('/administration/article');
                } else {
                    $this->_helper->FlashMessenger('L\'article a été créé ... ');
                    $this->_redirect('/administration/article/editer/id/' . $art->getId());
                }
            }
        }
        if ($id and ! $this->getRequest()->isPost()) {
            $form->populate($art->toArray());
        }
        $fmFldr = "article/" . $art->getId();
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
        $this->view->titre = $titre;
    }
}





