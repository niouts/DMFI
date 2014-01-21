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
class Administration_IndexController extends Zend_Controller_Action
{
	/**
	 * Redirection vers la liste des articles.
	 */
    public function indexAction()
    {
		$this->_redirect('/administration/article');
    }
}

