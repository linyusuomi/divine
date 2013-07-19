<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
chdir(dirname(__DIR__));

//If server version of PHP is lower than 5.4.0 add the following in your index.php. for zend deveöoper tool
define('REQUEST_MICROTIME', microtime(true));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// here we did not use default autoloader we use this vendor autoloader which we can use library got from composer 
// Setup autoloading
require 'init_autoloader.php';

Zend\Mvc\Application::init(require 'config/application.config.php')->run();
