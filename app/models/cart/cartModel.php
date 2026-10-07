<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/database.php";

class CartModel extends Model
{

    private static function getPendingOrderId(): false| int
    {
        $DB = database::getConnection();

        $authId = auth('id');

        $stmt = $DB->query("SELECT id FROM orders WHERE customer_id = {$authId} And status = 'pending' ;");

        return $stmt->fetchColumn();
    }

    private static function getOrderItemId(string $orderId, string $bookId): false| int
    {
        $DB = database::getConnection();

        $stmt = $DB->query("SELECT id FROM orders_items WHERE order_id = {$orderId} And book_id = {$bookId} ;");

        return $stmt->fetchColumn();
    }

    private static function updateTotalPriceOfOrder(string $orderId)
    {
        $DB = database::getConnection();

        $totalPrice = $DB->query("SELECT SUM(subtotal) AS total FROM orders_items WHERE order_id = {$orderId} ;")->fetchColumn() ?? 0;
        $DB->exec("UPDATE orders SET total_price = {$totalPrice} WHERE id = {$orderId};");

        return $totalPrice;
    }

    public static function totalItemsIntoOrder()
    {
        $DB = database::getConnection();
        $orderId = self::getPendingOrderId();

        if ($orderId == false) {
            return 0;
        }

        $totalItems = $DB->query("SELECT COALESCE(SUM(quantity) ,0) AS total FROM orders_items WHERE order_id = {$orderId} ;")->fetchColumn();

        return $totalItems;
    }

    public static function addToCart()
    {
        $DB = database::getConnection();

        $pendingOrderId = self::getPendingOrderId();
        $authId = auth('id');

        if ($pendingOrderId == false) {
            $DB->exec("INSERT INTO orders (customer_id) VALUES ('{$authId}'); ");

            $pendingOrderId = $DB->lastInsertId();
        }

        $bookId = request::input('bookId');
        $quantity = request::input('quantity');

        $orderItemId = self::getOrderItemId($pendingOrderId, $bookId);

        $unitPrice = $DB->query("SELECT price FROM books WHERE id = '{$bookId}'")->fetchColumn();

        if ($orderItemId == false) {

            $stmt = $DB->prepare("INSERT INTO orders_items 
            (order_id , book_id , quantity, unit_price , subtotal)
            VALUES
            (:order_id , :book_id , :quantity, :unit_price , :subtotal)
            ");

            $stmt->execute([
                'order_id' => $pendingOrderId,
                'book_id' => $bookId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => (float)$unitPrice * (int)$quantity,
            ]);
        } else {

            $newSubtotal = $unitPrice * $quantity;

            $DB->exec("UPDATE orders_items SET 
            quantity = quantity + {$quantity},
            subtotal = subtotal + {$newSubtotal}
            WHERE id = {$orderItemId}
            ");
        }

        self::totalItemsIntoOrder();

        $totalPrice = self::updateTotalPriceOfOrder($pendingOrderId);

        return [
            'totalPrice' =>  $totalPrice,
        ];
    }

    public static function getItemsIntoCart(?int $orderId = null)
    {
        $DB = database::getConnection();

        if ($orderId == null) {
            $orderId = self::getPendingOrderId();
        }

        $stmt = $DB->prepare("SELECT
                                    books.title,
                                    books.image,
                                    books.id AS book_id,
                                    books.description AS description,
                                    books.price,
                                    authors.name AS author_name,
                                    authors.id AS author_id,
                                    orders_items.id AS order_item_id,
                                    orders_items.quantity,
                                    orders_items.subtotal,
                                    orders.total_price,
                                    orders.id AS order_id
                                    FROM orders_items 
                                    LEFT JOIN orders ON orders.id = orders_items.order_id
                                    LEFT JOIN books ON books.id = orders_items.book_id
                                    LEFT JOIN authors ON authors.id = books.author_id
                                    WHERE orders.id  = :orders_id");

        $stmt->execute([
            'orders_id' => $orderId
        ]);

        return $stmt->fetchAll();
    }

    public static function increaseOrderItem()
    {
        $DB = database::getConnection();

        $stmt = $DB->prepare("UPDATE orders_items 
        SET quantity = quantity + 1 ,
        subtotal =subtotal + unit_price
        WHERE id = :orderItemId ");

        $stmt->execute([
            'orderItemId' => request::input('orderItemId')
        ]);

        $stmt = $DB->prepare("SELECT * FROM orders_items WHERE id = :orderItemId ");

        $stmt->execute([
            'orderItemId' => request::input('orderItemId')
        ]);

        $orderItem = $stmt->fetch();

        $orderId = self::getPendingOrderId();

        $totalPrice = self::updateTotalPriceOfOrder($orderId);
        $orderId = self::getPendingOrderId();
        $totalItemsIntoOrder = self::totalItemsIntoOrder();

        return [
            'totalItemsIntoOrder' =>  $totalItemsIntoOrder,
            'orderItem' =>  $orderItem,
            'orderId' =>  $orderId,
            'totalPrice' =>  $totalPrice,
        ];
    }

    public static function decreaseOrderItem()
    {
        $DB = database::getConnection();

        $stmt = $DB->prepare("UPDATE orders_items 
        SET quantity = quantity - 1 ,
        subtotal =subtotal - unit_price
        WHERE id = :orderItemId ");

        $stmt->execute([
            'orderItemId' => request::input('orderItemId')
        ]);

        $stmt = $DB->prepare("SELECT * FROM orders_items WHERE id = :orderItemId ");

        $stmt->execute([
            'orderItemId' => request::input('orderItemId')
        ]);

        $orderItem = $stmt->fetch();

        if ($orderItem['quantity'] == 0) {
            $stmt = $DB->prepare("DELETE FROM orders_items WHERE id = :orderItemId ");

            $stmt->execute([
                'orderItemId' => request::input('orderItemId')
            ]);
        }

        $orderId = self::getPendingOrderId();

        $totalPrice = self::updateTotalPriceOfOrder($orderId);
        $orderId = self::getPendingOrderId();
        $totalItemsIntoOrder = self::totalItemsIntoOrder();

        return [
            'totalItemsIntoOrder' =>  $totalItemsIntoOrder,
            'orderItem' =>  $orderItem,
            'orderId' =>  $orderId,
            'totalPrice' =>  $totalPrice,
        ];
    }

    public static function deleteOrderItem()
    {
        $DB = database::getConnection();

        $stmt = $DB->prepare("DELETE FROM orders_items WHERE id = :orderItemId ");

        $orderItemId = request::input('orderItemId');

        $stmt->execute([
            'orderItemId' => request::input('orderItemId')
        ]);


        $orderId = self::getPendingOrderId();
        $totalItemsIntoOrder = self::totalItemsIntoOrder();

        $totalPrice = self::updateTotalPriceOfOrder($orderId);

        return [
            'totalItemsIntoOrder' =>  $totalItemsIntoOrder,
            'totalPrice' =>  $totalPrice,
        ];
    }

    public static function fireOrder()
    {
        $DB = database::getConnection();

        $stmt = $DB->prepare("UPDATE orders SET status = 'ordered' WHERE id = :orderId ");

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
        ORDER BY orders.created_at DESC, orders.id DESC 
        ");

        return $stmt->fetchAll();
    }
}
