<?php
namespace MikhailovIgor\Lib;
use Core\Configs\Consts;
use Exception;
use PDO;

class DBConnector {
    private static $dsn = "mysql:dbname=" . Consts::DB_NAME . ";host=" . Consts::MYSQL_SERVER;
    private static $pdo = NULL;
    


    private function __construct() {}

    public static function getPdo()
    {
        if (self::$pdo === NULL) {
            try {
                self::$pdo = new PDO(self::$dsn, Consts::DB_USER_NAME, Consts::DB_USER_PASSWORD);
            } catch (PDOException $e) {
                echo 'Подключение не удалось: ' . $e->getMessage();
            }
        }
        return self::$pdo;
    }
    
}