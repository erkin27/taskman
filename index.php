<?php
//use app\core\Request;
//use app\core\Router;

//require '_vendor_old/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/bootstrap.php';

Router::load($_SERVER['DOCUMENT_ROOT'].'/routes.php')
    ->direct(Request::uri(), Request::method());