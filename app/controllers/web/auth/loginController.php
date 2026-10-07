<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/auth/authModel.php";

class loginController extends controller
{
    public function index()
    {
        $this->view("auth/login");
    }

    public function login()
    {
        $errors = request::validate([
            'email' => ['required', 'email'],
            'password' => ['required', ['min', 8]]
        ]);

        if (!empty($errors)) {
            back();
        }

        if (AuthModel::login()) {
            $_SESSION['_old'] = [];
            session_regenerate_id(true);
            redirect('/profile');
        }

        back('invalid', "invalid Account");
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_regenerate_id(true);
        redirect('/auth/login');
    }
}
