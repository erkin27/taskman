<?php

namespace app\controllers;


class Controller
{
    public function view($name, $data = [])
    {
        extract($data);

        return require $_SERVER['DOCUMENT_ROOT'].  "/views/{$name}.view.php";
    }

    public function redirect($path)
    {
        header("Location: /{$path}");
    }
}