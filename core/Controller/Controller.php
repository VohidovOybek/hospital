<?php


namespace Warehouse\Controller;


class Controller
{
    public function redirect($url)
    {
        header("Location: $url");
    }
}