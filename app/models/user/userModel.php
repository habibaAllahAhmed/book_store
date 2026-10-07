<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/database.php";

class UserModel extends Model
{
    public static function createUser()
    {
        $DB = database::getConnection();

        $data = request::all();
        $hashPass = password_hash($data['password'], PASSWORD_DEFAULT);

        $DB->exec("INSERT INTO users 
        (role ,name, email, password, phone, gender)
        VALUES 
        ('{$data['role']}','{$data['name']}','{$data['email']}' ,'{$hashPass}','{$data['phone']}','{$data['gender']}')");
    }

    public static function editUser(string $column, string $value)
    {
        $DB = database::getConnection();

        if ($column == 'password') {
            $value = password_hash($value, PASSWORD_DEFAULT);
        }

        $authId = auth('id');
        $DB->exec("UPDATE users SET {$column} = '{$value}'
                           WHERE id = '{$authId}' ;");
    }
}
