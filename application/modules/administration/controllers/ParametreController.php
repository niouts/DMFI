<?php
/**
 * Controleurs de la partie Administration
 */
/**
 * Controleur de l'affichage de gestion des param�tres.
 * @package DMFI\Administration\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class Administration_ParametreController extends Zend_Controller_Action
{

    /**
     * Affichage de la liste des param�tres
     */
    public function indexAction()
    {
        $this->view->headLink()->appendStylesheet('/css/administration/parametre/index.css');
        
        $aParametres = array();
        $aParams = Application_Model_Object_Parametre::all(null, 'prm_code asc');
        $current = '';
        
        foreach ($aParams as $param) {
            $bloc = substr($param->getCode(), 0, strpos($param->getCode(), '_'));
            $aParametres[$bloc][] = $param;
        }
        
        $this->view->aParametres = $aParametres;
        $this->view->FlashMessages = $this->_helper->FlashMessenger->getMessages();
    }

    /**
     * Edition du param�tre dont l'id est post�.
     *
     * Cr�ation du r�pertoire du param�tre afin de stocker les documents attach� au contenu
     * (s'il n'exite pas) dans le dossier /documents/parametre/$id.
     * Apr�s la sauvegarde, redirection vers la liste principale.
     */
    public function editerAction()
    {
        $this->view->headLink()->appendStylesheet('/css/index/index.css');
        $this->view->headLink()->appendStylesheet('/css/administration/parametre/editer.css');
        $id = $this->_getParam('id', false);
        
        if ($id) {
            $param = Application_Model_Object_Parametre::find($id);
        } else {
            $this->_helper->FlashMessenger('S�lectionnez un param�tre ... ');
            $this->_redirect('/administration/parametre');
        }

        if (strstr($param->getCode(), 'contenu')) {
            $this->view->headScript()->appendFile('/js/library/tiny_mce/tiny_mce.js');
            $this->view->headScript()->appendFile('/js/administration/parametre/editer.js');
        }
        
        $bloc = substr($param->getCode(), 0, strpos($param->getCode(), '_'));
        $form = new Administration_Form_Parametre(null, $bloc);
        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
            $values = $form->getValues();
            $param = new Application_Model_Object_Parametre($values);
            $param->save();
            if ($id)
                $this->_helper->FlashMessenger('Le param�tre a �t� modifi� ... ');
            else
                $this->_helper->FlashMessenger('Le param�tre a �t� cr�� ... ');
            $this->_redirect('/administration/parametre');
        }
        
        if (! $this->getRequest()->isPost()) {
            $form->populate($param->toArray());
        }
        
        $fmFldr = "parametre/" . $param->getId();
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

