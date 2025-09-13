<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = getenv("DB_HOST");
        $port = getenv("DB_PORT");
        $dbname = getenv("DB_NAME");
        $user = getenv("DB_USER");
        $pass = getenv("DB_PASS");

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

        try {
            $this->conn = new PDO($dsn, $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
