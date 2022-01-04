<?php


namespace Warehouse\View;


class View
{
    protected static $content = '';

    public static function render(string $path, array $data = [])
    {
        ob_start();
        $path_with_dot = $path;
        if (count($data) > 0) {
            extract($data);
        }
        $path_with_slashes = str_replace('.', '/', $path_with_dot);
        $base_path = $_SERVER['DOCUMENT_ROOT'] . "/resources/views/";
        $file_path = $base_path . $path_with_slashes . ".php";
        require_once $file_path;
        echo ob_get_clean();
    }

    public static function genereta_html(string $path, array $data = [])
    {
        ob_start();
        $path_with_dot = $path;
        if (count($data) > 0) {
            extract($data);
        }
        $path_with_slashes = str_replace('.', '/', $path_with_dot);
        $base_path = $_SERVER['DOCUMENT_ROOT'] . "/resources/views/";
        $file_path = $base_path . $path_with_slashes . ".php";
        require_once $file_path;
        return ob_get_clean();
    }

    public static function parentLayout(string $layout_name)
    {
        ob_start();
        $path_with_dot = $layout_name;
        $path_with_slashes = str_replace('.', '/', $path_with_dot);
        $base_path = $_SERVER['DOCUMENT_ROOT'] . "/resources/views/";
        $file_path = $base_path . $path_with_slashes . ".php";
        require_once $file_path;
        echo ob_get_clean();
    }

    public static function StartContent()
    {
        ob_start();
    }

    public static function EndContent()
    {
        self::$content = ob_get_clean();
    }

    public static function content()
    {
        echo self::$content;
    }
}
