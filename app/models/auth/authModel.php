<?php


require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/database.php";


class AuthModel extends Model
{
    public static function login(): bool
    {
        $DB = database::getConnection();

        $email = request::input('email');
        $password = request::input('password');

        $stmt = $DB->prepare("SELECT * FROM users WHERE email = :email ;");

        $stmt->execute([
            'email' => $email
        ]);

        $result = $stmt->fetch();

        if (!empty($result) && password_verify($password, $result['password'])) {

            $_SESSION['user'] = $result;
            return true;
        }

        return false;
    }
}
