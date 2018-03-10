<?php

namespace app\models;

use app\models\base\Model;

class User extends Model
{
    public $login;
    public $password;

    protected $attributes = [
        'login',
        'password'
    ];

    public function isAdmin()
    {
        if ($this->login === 'admin') {
            if ($this->password === '123')
            {
                return true;
            }
        }
        return false;
    }

    public static function saveAdmin()
    {
        session_start();
        if (!isset($_SESSION['admin'])) $_SESSION['admin'] = 1;
    }

    public static function removeAdmin()
    {
        session_start();
        if (isset($_SESSION['admin'])) unset($_SESSION['admin']);
    }

    public static function isActiveAdmin()
    {
        session_start();
        return isset($_SESSION['admin']);
    }
}