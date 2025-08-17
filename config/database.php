<?php
class Database {
    private static $host = '127.0.0.1';
    private static $dbName = 'product_catalog_system';
    private static $username = 'root';
    private static $password = '';
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {
            $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbName . ';charset=utf8mb4';
            self::$pdo = new PDO($dsn, self::$username, self::$password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
