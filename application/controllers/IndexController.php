<?php
/**
 * Controleurs de la partie Front office
 */
/**
 * Controleur de l'affichage de la page principale.
 * @package DMFI\FrontOffice\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class IndexController extends Zend_Controller_Action
{
	/**
	 * Affichage de la page principale contenant les articles affichables ainsi que les autres blocs.
	 */
    public function indexAction()
    {
        $this->view->headLink()->appendStylesheet('/css/index/index.css');
		
        $aParams = Application_Service_Parametre::getAll();
        $aJust = Application_Model_Object_JustOneClick::all(null, 'joc_ordre');
        
        $condition = 'art_publication_dt <= CURRENT_DATE AND '.
            '(art_fin_publication_dt IS NULL OR art_fin_publication_dt >= CURRENT_DATE)';
        $aActus = Application_Model_Object_Article::all(
            $condition.' AND art_transverse = 0', 'art_publication_dt desc'
        );
        $aActusTransv = Application_Model_Object_Article::all(
            $condition.' AND art_transverse = 1', 'art_publication_dt desc'
        );
        
        $this->view->params = $aParams;
        $this->view->just = $aJust;
        $this->view->actus = $aActus;        
        $this->view->actusTransv = $aActusTransv;
    }

}

