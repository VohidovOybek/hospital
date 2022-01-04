<?php


namespace Warehouse\Application;
use Warehouse\Request\Request;
use Warehouse\Route\Route;

class Application
{
    public Route $route;
    public Request $request;
    public Api $telegram;

    public function __construct()
    {
        session_start();
        $this->route = new Route();
        $this->request = new Request();
    }

    public function run()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/routes/web.php";
        $this->route->run();
    }

}