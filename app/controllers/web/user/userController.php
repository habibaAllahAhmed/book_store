<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/user/userModel.php";
require_once __DIR__ . "/../../../../core/request.php";

class UserController extends controller
{
    public function editName()
    {
        $errors = request::validate([
            'name' => ['required'],
        ]);

        if (!empty($errors)) {
            $_SESSION['_errors'] = [];
            back('editAlert', ['error', $errors['name'][0]]);
        }

        UserModel::editUser('name', request::input('name'));

        $_SESSION['user']['name'] = request::input('name');
        $_SESSION['_old'] = [];
        back('editAlert', ['success', 'name has been updated successfully.']);
    }


    public function editEmail()
    {
        $errors = request::validate([
            'email' => ['required', 'email', ['unique', 'users', auth('id')]]
        ]);

        if (!empty($errors)) {
            $_SESSION['_errors'] = [];
            back('editAlert', ['error', $errors['email'][0]]);
        }


        UserModel::editUser('email', request::input('email'));

        $_SESSION['user']['email'] = request::input('email');
        $_SESSION['_old'] = [];
        back('editAlert', ['success', 'email has been updated successfully.']);
    }


    public function editPassword()
    {
        $errors = request::validate([
            'password' => ['required', ['min', 8]],
        ]);

        if (!empty($errors)) {
            $_SESSION['_errors'] = [];
            back('editAlert', ['error', $errors['password'][0]]);
        }

        UserModel::editUser('password', request::input('password'));

        $_SESSION['_old'] = [];
        back('editAlert', ['success', 'password has been updated successfully.']);
    }


    public function editPhone()
    {
        $errors = request::validate([
            'phone' => ['required', 'egPhone', ['unique', 'users', auth('id')]],
        ]);

        if (!empty($errors)) {
            $_SESSION['_errors'] = [];
            back('editAlert', ['error', $errors['phone'][0]]);
        }


        UserModel::editUser('phone', request::input('phone'));

        $_SESSION['user']['phone'] = request::input('phone');
        $_SESSION['_old'] = [];
        back('editAlert', ['success', 'phone has been updated successfully.']);
    }

    public function editGender()
    {
        $errors = request::validate([
            'gender' => ['required'],
        ]);

        if (!empty($errors)) {
            $_SESSION['_errors'] = [];
            back('editAlert', ['error', $errors['gender'][0]]);
        }

        UserModel::editUser('gender', request::input('gender'));

        $_SESSION['user']['gender'] = request::input('gender');
        $_SESSION['_old'] = [];
        back('editAlert', ['success', 'gender has been updated successfully.']);
    }
}
