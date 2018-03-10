<?php

namespace app;

use app\core\App;
use app\core\database\Connection;
use app\core\database\QueryBuilder;

App::bind('config', require_once $_SERVER['DOCUMENT_ROOT'].'/config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));