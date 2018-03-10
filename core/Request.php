<?php

namespace app\core;


class Request
{
    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function params()
    {
        $params = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($params, $queryParams);
        return $queryParams;
    }
}