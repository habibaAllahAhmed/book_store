<?php

class database
{
    private const DNS = "mysql:host=fdb1029.awardspace.net;dbname=4794400_habiba";
    private const username = "4794400_habiba";
    private const password = "@0511lumis";

    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(self::DNS, self::username, self::password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("database connection failed: {$e->getMessage()}");
            }
        }

        return self::$connection;
    }
}
