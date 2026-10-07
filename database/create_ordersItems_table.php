

<?php
require_once __DIR__ . "/../core/database.php";

class create_ordersItems_table
{
    public static function up()
    {
        database::getConnection()->exec("CREATE TABLE IF NOT EXISTS ordersItems(
        id BIGINT UNSiGNED AUTO_INCREMENT PRIMARY KEY,  
        order_id BIGINT UNSIGNED NOT NULL,
        CONSTRAINT fk_order_id FOREIGN KEY (order_id) REFERENCES orders(id),
        book_id BIGINT UNSIGNED NOT NULL,
        CONSTRAINT fk_book_id FOREIGN KEY (book_id) REFERENCES books(id),
        quantity iNT UNSIGNED,
        unit_price DECIMAL(10,2),
        subtotal DECIMAL(10,2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }

    public static function down()
    {
        database::getConnection()->exec("DROP TABLE IF EXISTS ordersItems");
    }
}
