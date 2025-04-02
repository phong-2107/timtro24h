<?php
namespace QLPhongTro\Config;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = require __DIR__ . '/../Config/DB.php';

        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
            $this->connection = new PDO($dsn, $config['user'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \Exception("Kết nối database thất bại: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}