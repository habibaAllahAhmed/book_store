<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/database.php";

class DBModel extends Model
{

    public static function getTotalOfTable(string $tableName, array $wheres = [])
    {
        $DB = database::getConnection();

        $wheresQuery = Model::prepareWhereQuery($wheres);

        $stmt = $DB->query("SELECT count(*) AS total FROM {$tableName}
        {$wheresQuery}
        ; ");

        $result = $stmt->fetch();

        return $result['total'];
    }

    public static function getTotalBoughtBooksOfCustomer()
    {

        $DB = database::getConnection();

        $customerId = auth('id');

        $stmt = $DB->query("SELECT COALESCE(SUM(orders_items.quantity), 0)  AS total 
        FROM orders_items LEFT JOIN orders ON orders.id = orders_items.order_id WHERE
        orders.customer_id = {$customerId}
        AND orders.status = 'ordered'
        ; ");

        return $stmt->fetchColumn();
    }


    public static function getDataOfTable(string $tableName, array $wheres = [], int $page = 1): array
    {
        $DB = database::getConnection();

        $whereQuery = Model::prepareWhereQuery($wheres);
        $offset = ($page * 10) - 10;

        $stmt = $DB->query("SELECT * FROM {$tableName}
        {$whereQuery}
        ORDER BY id DESC
        LIMIT 10 OFFSET {$offset} ;");

        $data = $stmt->fetchAll();

        $stmt = $DB->query("SELECT COUNT(*) AS total FROM {$tableName}
        {$whereQuery} ;");


        $total = $stmt->fetch()['total'];

        return [
            'data' => $data,
            'total' => $total,
            'currentPage' => $page
        ];
    }


    public static function getRoleOfUser(string $userId): string
    {
        $DB = database::getConnection();

        $stmt = $DB->query("SELECT role FROM users WHERE id = {$userId} ;");

        return $stmt->fetchColumn();
    }
}
