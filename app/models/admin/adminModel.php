<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/database.php";

class AdminModel extends Model
{

    public static function banUser()
    {
        $DB = database::getConnection();

        $userId = request::input('userId');

        $stmt = $DB->prepare("SELECT * FROM users WHERE id = :userId;");

        $stmt->execute([
            'userId' => $userId,
        ]);

        $user = $stmt->fetch();

        $stmt = $DB->prepare("UPDATE users SET is_banned = :newBan
    WHERE id = :userId
    ");

        $user['is_banned'] = !$user['is_banned'];

        $stmt->execute([
            'newBan' => (int)$user['is_banned'],
            'userId' => $userId,
        ]);

        return $user;
    }

    public static function doneOrder()
    {
        $DB = database::getConnection();

        $stmt = $DB->prepare("UPDATE orders SET status = 'done' WHERE id = :orderId;");

        $stmt->execute([
            'orderId' => request::input('orderId')
        ]);

        $orderId = request::input('orderId');

        $stmt = $DB->query("SELECT 
        orders.total_price,
        orders.created_at,
        orders.id AS order_id,
        users.id AS user_id,
        users.name
        FROM orders LEFT JOIN users ON orders.customer_id = users.id 
        WHERE orders.id = {$orderId} 
        ORDER BY orders.created_at DESC, orders.id DESC");

        return $stmt->fetchAll();
    }

    public static function cancelOrder()
    {
        $DB = database::getConnection();

        $stmt = $DB->prepare("UPDATE orders SET status = 'canceled' WHERE id = :orderId;");

        $stmt->execute([
            'orderId' => request::input('orderId')
        ]);

        $orderId = request::input('orderId');

        $stmt = $DB->query("SELECT 
        orders.total_price,
        orders.created_at,
        orders.id AS order_id,
        users.id AS user_id,
        users.name
        FROM orders LEFT JOIN users ON orders.customer_id = users.id 
        WHERE orders.id = {$orderId}
        ORDER BY orders.created_at DESC, orders.id DESC ");

        return $stmt->fetchAll();
    }
}
