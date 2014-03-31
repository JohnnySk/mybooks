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
)));
//define public directory
define('DIR_PUBLIC', dirname(__DIR__).'/public/');
//define base url
define('BASE_URL', "http://" . $_SERVER['SERVER_NAME']
    . str_replace($_SERVER['DOCUMENT_ROOT'], '', DIR_PUBLIC));
//define css folder
define('APPLICATION_CSS_FOLDER', DIR_PUBLIC.'css/');
//define js folder
define('APPLICATION_JS_FOLDER', DIR_PUBLIC.'js/');
//define application folder
define('APPLICATION_FOLDER', dirname(__DIR__).'/application/');

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();