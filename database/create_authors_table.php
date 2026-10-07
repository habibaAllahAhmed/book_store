<?php
require_once __DIR__ . "/../core/database.php";

class create_authors_table
{
    public static function up()
    {
        database::getConnection()->exec("CREATE TABLE IF NOT EXISTS authors(
        id BIGINT UNSiGNED AUTO_INCREMENT PRIMARY KEY,  
        name VARCHAR(255) NOT NULL,
        bio TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }

    public static function down()
    {
        database::getConnection()->exec("DROP TABLE IF EXISTS authors");
    }
}
