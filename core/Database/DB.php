<?php


namespace Warehouse\Database;


class DB
{

    public static array $config;

    public static $connection = null;

    public static $db = null;

    public function __construct()
    {
        self::$config = require $_SERVER['DOCUMENT_ROOT'] . "/config/database.php";
    }

    public static function getSingleObject() // singleton
    {
        if (!self::$db) {
            self::$db = new static;
        }
        return self::$db;
    }

    public static function connect()
    {
        if (!self::$connection) {
            try {
                $conn = new \PDO(
                    "mysql:host=" . self::$config['mysql']['server'] . ";dbname=" . self::$config['mysql']['database'],
                    self::$config['mysql']['username'],
                    self::$config['mysql']['password']
                );
                // set the PDO error mode to exception
                $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$connection = $conn;
            } catch (\PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
}