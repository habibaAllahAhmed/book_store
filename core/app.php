<?php

class  app
{

    public static function run()
    {

        session_start();

        // session_unset();

        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $type = str_starts_with($url, BASE_URL . "/api") ? 'api' : 'web';

        if ($type === "api") {
            header('content-type: application/json; charset=UTF-8');
            header('access-control-allow-origin:* ');
            header('access-control-allow-methods: GET, Post, Put , Patch, Delete, Options');
            header('access-control-allow-headers:content-type , Authorization');
        }

        require_once __DIR__ . "/../routes/{$type}.php";
        require_once __DIR__ . "/route.php";
        require_once __DIR__ . "/../app/helpers/functions.php";
        require_once __DIR__ . "/../app/middleware/AuthMiddleware.php";
        require_once __DIR__ . "/response.php";
        require_once __DIR__ . "/request.php";
        require_once __DIR__ . "/validation.php";

        // unset($_SESSION['user']);
        Route::dispatch();
    }
}
