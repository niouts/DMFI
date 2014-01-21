<?php
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
    '/exec/adm/lib/ZendFramework/1.10.7/library'
)));

if(!function_exists('get_called_class')) {
	class class_tools {
		static $i = 0;
		static $fl = null;

		static function get_called_class() {
		    $bt = debug_backtrace();

			if (self::$fl == $bt[2]['file'].$bt[2]['line']) {
			    self::$i++;
			} else {
			    self::$i = 0;
			    self::$fl = $bt[2]['file'].$bt[2]['line'];
			}

			$lines = file($bt[2]['file']);

			$j =1;
			do {
			preg_match_all('/([a-zA-Z0-9\_]+)::'.$bt[2]['function'].'/',
			    $lines[$bt[2]['line']-$j],
			    $matches);
			    $j++;
			} while(!$matches[1] && $j < 15);
			
			if (!isset($matches[1][self::$i])) {
				die('la fonction '.$bt[2]['function'].' est sur plus 15 lignes dans le fichier '.$bt[2]['file'].' à la ligne '.$bt[2]['line']);
			}
	        return $matches[1][self::$i];
	    }
	}

	function get_called_class() {
	    return class_tools::get_called_class();
	}
}

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();