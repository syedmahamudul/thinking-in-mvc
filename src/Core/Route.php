<?php
namespace Src\Core;

class Route
{
    private static $routes = [];

    public static function get($uri, $callback)
    {
        self::$routes['GET'][$uri] = $callback;
    }

    public static function resolve()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if(isset(self::$routes[$method][$requestUri])) {
            $callback = self::$routes[$method][$requestUri];

            if(is_string($callback)) {
                // Controller@method
                [$controller, $method] = explode('@', $callback);
                $controllerClass = "Src\\Controllers\\$controller";
                $controllerObj = new $controllerClass();
                return $controllerObj->$method();
            } elseif(is_callable($callback)) {
                return call_user_func($callback);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}