<?php
/**
 * Controleurs de la partie Front office
 */
/**
 * Controleur de l'affichage des rubriques, sous rubriques et des articles
 * @package DMFI\FrontOffice\Controllers
 * @author GFI
 * @link http://framework.zend.com/apidoc/1.10/_Controller_Action.html
 * Zend_Controller_Action
 */
class AfficherController extends Zend_Controller_Action
{
	/**
	 * Affichage de la page d'accueil de la rubrique
	 *
	 * La rubrique est passee en premier parametre dans l'url
	 * Si l'url n'est pas correcte, redirection vers la racine du site.
	 * La page est definie en base de donnees T_RUBRIQUE->rub_accueil.
	 */
    public function rubriqueAction()
    {
        //Vérification de la cohérence de l'url
        try {
        	$mapper = new Application_Model_Mapper_Rubrique();
        	$rubrique = $mapper->findByAdresse($this->_request->getParam('rubrique'));	
        } catch(Exception $e) {
        	$this->_redirect('/');
        }
        
        //Affichage de la page d'accueil de la rubrique
        echo $rubrique->getAccueil();
    }

    /**
     * Affichage de la page d'accueil de la sous-rubrique passée en second parametre dans l'url.
     * Si l'url n'est pas correcte, redirection vers la racine du site.
     * Liste tous les articles de la sous-rubrique dont la date de publication 
     * est inférieure ou égale à la date du jour.
     */
    public function sousrubriqueAction()
    {
    	$this->view->headScript()->appendFile('/js/afficher/sousrubrique.js');
        $this->view->headLink()->appendStylesheet('/css/afficher/sousrubrique.css');
        
       	//Vérification de la cohérence de l'url
        try {
        	$mapper = new Application_Model_Mapper_SousRubrique();
        	$sousRubrique = $mapper->findByAdresse(
        		$this->_request->getParam('rubrique'),
        		$this->_request->getParam('sousrubrique')
        	);

			if ($sousRubrique->getRubrique()->getAdresse() != $this->_request->getParam('rubrique')) {
	        	throw new Exception('Rubrique et sous rubrique incohérentes', 0);
	        }
        } catch(Exception $e) {
        	$this->_redirect('/');
        }
        
        //Chargement des actus
        $aActus = Application_Model_Object_Article::all(
            'art_publication_dt <= CURRENT_DATE AND srub_id = '.$sousRubrique->getId(), 
            'art_publication_dt desc'
        );
        
        $this->view->titre = $sousRubrique->getLibelle();
        $this->view->actus = $aActus; 
    }

    /**
     * Affichage de l'article passée en troisième paramètre dans l'url.
     * Si l'url n'est pas correcte, redirection vers la racine du site. 
     * L'article est définie en base de données T_ARTICLE.
     */
    public function articleAction()
    {
        $this->view->headLink()->appendStylesheet('/css/afficher/article.css');
		
        //Vérification de la cohérence de l'url
        try {
        	$mapper = new Application_Model_Mapper_Article();
        	$article = $mapper->findByAdresse($this->_request->getParam('article'));	
			if ($article->getSousRubrique()->getAdresse() != $this->_request->getParam('sousrubrique') ||
				$article->getSousRubrique()->getRubrique()->getAdresse() != $this->_request->getParam('rubrique')) {
	        	throw new Exception('Rubrique et sous rubrique incohérentes', 0);
	        }
        } catch(Exception $e) {
        	$this->_redirect('/');
        }
        
        $this->view->article = $article;
    }


}







