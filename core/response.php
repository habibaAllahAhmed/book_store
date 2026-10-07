<?php

class response
{
    public static function error(string $msg, int $status = 200): void
    {
        http_response_code($status);
        echo $msg;
        exit;
    }
    public static function json(array $data, string $msg = "", int $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=UTF-8');

        echo json_encode([
            "message" => $msg,
            "data" => $data,
        ]);

        exit;
    }
}
