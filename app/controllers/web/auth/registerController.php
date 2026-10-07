<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/user/userModel.php";

class RegisterController extends controller
{
    public function index()
    {
        $this->view("auth/register");
    }

    public function register()
    {
        $errors = request::validate([
            'role' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email', ['unique', 'users']],
            'password' => ['required', ['min', 8]],
            'phone' => ['required', 'egphone'],
            'gender' => ['required'],
        ]);

        if (!empty($errors)) {
            back();
        }

        if (request::input('role') == 'admin' && !isAuth('admin')) {
            back('invalid', "you must log in as admin");
        }

        UserModel::createUser();
        $newRole = request::input('role');
        back('correct', "new {$newRole} created successfully");
    }
}
