<?php
require_once __DIR__ . "/../core/database.php";

class create_orders_table
{
    public static function up()
    {
        database::getConnection()->exec("CREATE TABLE IF NOT EXISTS orders(
        id BIGINT UNSiGNED AUTO_INCREMENT PRIMARY KEY,  
        customer_id BIGINT UNSIGNED NOT NULL,
        CONSTRAINT fk_customer_id FOREIGN KEY (customer_id) REFERENCES users(id),
        status ENUM('pending', 'cancelled', 'done','ordered') DEFAULT 'pending',
        cancel_reason TEXT NOT NULL,
        total_price DECIMAL(10,2) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }

    public static function down()
    {
        database::getConnection()->exec("DROP TABLE IF EXISTS orders");
    }
}
