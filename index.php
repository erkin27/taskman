<?php
use app\Autoloader;
use app\core\Request;
use app\core\Router;

require $_SERVER['DOCUMENT_ROOT'] . '/Autoloader.php';
$autoload = new Autoloader();
$autoload->addNamespace('app', $_SERVER['DOCUMENT_ROOT']);
$autoload->register();

require $_SERVER['DOCUMENT_ROOT'].'/bootstrap.php';

Router::load($_SERVER['DOCUMENT_ROOT'].'/routes.php')
    ->direct(Request::uri(), Request::method());