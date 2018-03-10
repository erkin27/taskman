<?php

namespace app\controllers;


use app\core\Request;
use app\models\User;

class UserController extends Controller
{
    public function login()
    {
        $user = new User();

        if (Request::method() === 'POST') {
            $params = $_POST;
            $user->load($params);
            $user->validate();

            if ($user->isAdmin()) {
                User::saveAdmin();
                return $this->redirect('index');
            }
        }

        return $this->view('sign_in', ['message' => 'Signin failed. Incorrect login or password']);
    }

    public function signIn()
    {
        return $this->view('sign_in');
    }

    public function logout()
    {
        User::removeAdmin();

        return $this->redirect('sign_in');
    }
}