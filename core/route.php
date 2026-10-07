<?php

class route
{

    private static array $routes = [];

    public static function get(string $url, string $controller, string $action, array $middlewares = []): void
    {
        self::$routes[] = [
            "url" => $url,
            "method" => "GET",
            "controller" => $controller,
            "action" => $action,
            "middlewares" => $middlewares,
        ];
    }

    public static function post(string $url, string $controller, string $action, array $middlewares = []): void
    {
        self::$routes[] = [
            "url" => $url,
            "method" => "POST",
            "controller" => $controller,
            "action" => $action,
            "middlewares" => $middlewares,
        ];
    }

    public static function routes(): array
    {
        return self::$routes;
    }

    public static function dispatch()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $flag = false;

        if ($url !== '/') {
            $url = rtrim($url, '/');
        }

        foreach (self::$routes as $route) {
            $args = self::matchRoute(BASE_URL . $route['url'], $url);

            if ($args !== false) {

                if ($method !== $route['method']) {
                    $flag = true;
                    continue;
                }

                $flag = false;

                self::handleMiddleware($route['middlewares']);

                $obj = new $route['controller']();
                $obj->{$route['action']}(...$args);

                return;
            }
        }

        if ($flag) {
            response::error("{$route['method']} not allowed", 405);
        }
        response::error("404 not found", 404);
    }

    private static function matchRoute(string $route, string $url): false | array
    {
        $regex = "/\{[A-Za-z_][A-Za-z_0-9]*\}/";
        $pattern = preg_replace($regex, "([^/]+)", $route);
        $pattern = "#^{$pattern}$#";

        if (!preg_match($pattern, $url, $matches)) {
            return false;
        }

        unset($matches[0]);
        return $matches;
    }

    private static function handleMiddleware(array $middlewares): void
    {

        foreach ($middlewares as $middleware) {
            $args = [];

            if (str_contains($middleware, ":")) {
                $arr = explode(":", $middleware);
                $middleware = $arr[0];

                $args = explode(",", $arr[1]);
            }
            (new $middleware())->handle(...$args);
        }
    }
}
