<?php

namespace app;

class Autoloader
{
    protected $namespaceClassMap = [];

    function addNamespace($namespace, $dir)
    {
        if (is_dir($dir)) {
            $this->namespaceClassMap[$namespace] = $dir;
            return true;
        }
        return false;
    }

    protected function autoload($class)
    {
        $pathClass = explode('\\', $class);

        if (is_array($pathClass)) {
            $namespace = array_shift($pathClass);

            if (!empty($this->namespaceClassMap[$namespace])) {
                require_once $this->namespaceClassMap[$namespace] . '/' . implode('/', $pathClass) . '.php';
            }
        }
    }

    function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

}