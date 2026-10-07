<?php

require_once __DIR__ . "/../../controller.php";
require_once __DIR__ . "/../../../models/admin/adminModel.php";
require_once __DIR__ . "/../../../models/db/DBModel.php";

class AdminController extends controller
{
    public function banUser()
    {
        $errors = request::validate([
            'userId' => ['required', ['exists', 'users', 'id']]
        ]);

        if (!empty($errors)) {
            response::json($errors, status: 422);
        }

        $idOfBanUser = request::input('userId');
        $roleOfBanUser = DBModel::getRoleOfUser($idOfBanUser);

        if ($roleOfBanUser == 'admin' && auth('id') > $idOfBanUser) {
            response::json([], 'You cannot ban an admin who is older than you.', 422);
        }

        $user =  AdminModel::banUser();

        response::json($user);
    }

    public function doneOrder()
    {
        $errors = request::validate([
            'orderId' => ['required', ['exists', 'orders', 'id']]
        ]);

        if (!empty($errors)) {
            response::json($errors, status: 422);
        }

        $data = AdminModel::doneOrder();

        response::json($data);
    }


    public function cancelOrder()
    {
        $errors = request::validate([
            'orderId' => ['required', ['exists', 'orders', 'id']]
        ]);

        if (!empty($errors)) {
            response::json($errors, status: 422);
        }

        $data = AdminModel::cancelOrder();

        response::json($data);
    }
}
