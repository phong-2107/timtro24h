<?php
namespace NguyenPhong\BtComposerQlsv\Models;

class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../../config/database.php';
            self::$connection = new \mysqli(
                $config['host'],
                $config['user'],
                $config['password'],
                $config['dbname']
            );
            if (self::$connection->connect_error) {
                die("Kết nối thất bại: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}