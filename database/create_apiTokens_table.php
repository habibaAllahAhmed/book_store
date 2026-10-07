<?php
require_once __DIR__ . "/../core/database.php";

class create_apiTokens_table
{
    public static function up()
    {
        database::getConnection()->exec("CREATE TABLE IF NOT EXISTS apiTokens(
        id BIGINT UNSiGNED AUTO_INCREMENT PRIMARY KEY,  
        user_id BIGINT UNSIGNED NOT NULL,
        CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users(id),
        token VARCHAR(255) UNIQUE,
        expires_at TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }

    public static function down()
    {
        database::getConnection()->exec("DROP TABLE IF EXISTS apiTokens");
    }
}
