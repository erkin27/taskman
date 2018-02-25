<?php


//use app\core\App;
//use app\core\database\Connection;
//use app\core\database\QueryBuilder;

require_once $_SERVER['DOCUMENT_ROOT'].'/core/App.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/AppController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/UserController.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/core/database/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/database/QueryBuilder.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/base/Model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/Task.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/pagination/Button.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/pagination/Pagination.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/sort/Sort.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/core/Request.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/Router.php';

App::bind('config', require_once 'config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

function view($name, $data = [])
{
    extract($data);

    return require "views/{$name}.view.php";
}

function redirect($path)
{
    header("Location: /{$path}");
}