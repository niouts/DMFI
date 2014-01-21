<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initRoutes()
	{
		$frontController = Zend_Controller_Front::getInstance();
	    $router = $frontController->getRouter();
	    $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/routes.ini');
	    $router->removeDefaultRoutes();
	    $router->addConfig($config, 'routes');
	}
	
	protected function _initVues()
	{
		date_default_timezone_set('Europe/Paris');
	
		$this->bootstrap('view');
		$view = $this->getResource('view');
	
		$view->addHelperPath('Tools/View/Helper/', 'Tools_View_Helper');
	
		$view->headTitle('le domaine mobile France et international');
		
		$view->headLink()
			->appendStylesheet('/css/application.css')
			->appendStylesheet('/css/navigation/navigation.css')
			->appendStylesheet('/css/jquery.dataTables.css');
	
		$view->headScript()
			->appendFile('/js/library/jquery-1.10.1.min.js')
			->appendFile('/js/library/jquery.dataTables.min.js')
			->appendFile('/js/application.js')
			->appendFile('/js/navigation/navigation.js');
		
		return $view;
	}
	
	
}

