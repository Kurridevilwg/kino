<?php

class Connection {
    private static $conn;

    private function __construct(){}

    /* Возврат экземпляра объекта Connection (паттерн Singleton) */
    public static function get() {
        if (self::$conn === null) {
            self::$conn = new self();
        }
        return self::$conn;
    }

    public function connect() {
        $params = parse_ini_file('db.ini');
        if ($params === false) {
            echo ('Error. Не удалось найти файла с настройками подключения');
            die();
        }

        $conn_str = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", $params['host'], $params['port'], $params['database'], $params['user'], $params['password']);
        $pdo = new PDO($conn_str);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}