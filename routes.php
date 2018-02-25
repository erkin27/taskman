<?php
/**
 * @var $router Router;
 */
//use app\core\Router;

$router->get('', 'AppController@index');

$router->get('index', 'AppController@index');

$router->get('view', 'AppController@view');

$router->get('update', 'AppController@update');

$router->get('create', 'AppController@create');

$router->post('create', 'AppController@create');

$router->get('edit', 'AppController@edit');

$router->get('sign_in', 'UserController@signIn');

$router->post('login', 'UserController@login');

$router->get('logout', 'UserController@logout');



