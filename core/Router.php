<?php

//namespace app\core;
//
//use Exception;


class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new static();

        require $file;

        return $router;
    }

    public function direct($uri, $requestType)
    {
        //for example - about/culture

        if (key_exists($uri, $this->routes[$requestType])) {

            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );

        }

        throw new \Exception("No route defined for this URI");
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function callAction($controller, $action)
    {
//        $controllerName = 'app\\controllers\\'.$controller;
        $controller = new $controller();

        if (!method_exists($controller, $action)){
            throw  new \Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
}