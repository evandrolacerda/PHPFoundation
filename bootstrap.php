<?php
ini_set('display_errors', 1 );
error_reporting( E_ALL );

date_default_timezone_set('America/Sao_Paulo');
session_start();

define('BASE_PATH', dirname(__FILE__));
define('VIEWS_PATH', BASE_PATH . '/views/'); 

require_once './functions.php';

//autoload com namespaces
spl_autoload_register(function($class) {
    $class = str_replace('\\', '/', $class);   
    
    $fileName = BASE_PATH . '/'. $class . '.php';            
    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

