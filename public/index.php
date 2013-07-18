<?php

chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// here we did not use default autoloader we use this vendor autoloader which we can use library got from composer 
// Setup autoloading
require 'init_autoloader.php';

Zend\Mvc\Application::init(require 'config/application.config.php')->run();
