<?php


namespace Warehouse\Route;


use Closure;
use Warehouse\Request\Request;
use Warehouse\View\View;

class Route
{

    public Request $request;

    public static array $routes = [];

    public function __construct()
    {
        $this->request = new Request();
    }


    /**
     * @param string $url
     * @param array|\Closure $param
     */
    public static function get(string $url, $param)
    {
        self::$routes['get'][$url] = $param;
    }

    public static function post(string $url, $param)
    {
        self::$routes['post'][$url] = $param;
    }

    public function run()
    {
        $request_method = $this->request->getMethod();
        $current_called_url = $this->request->getPath();
        if (array_key_exists($current_called_url, self::$routes[$request_method])) {
            $action = self::$routes[$request_method][$current_called_url];
            if ($action instanceof Closure) {
                call_user_func($action);
            } elseif (is_array($action)) {
                $controller = $action[0];
                $method = $action[1];
                $controller = new $controller();
                $controller->$method();
            }
        } else {
            View::render('404');
        }
    }
}