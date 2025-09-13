<?php
require_once "Database.php";

class Singer {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function addSinger($name, $birthdate, $genre) {
        $sql = "INSERT INTO Singer (name, birthdate, genre) VALUES (:name, :birthdate, :genre)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':birthdate' => $birthdate,
            ':genre' => $genre
        ]);
    }

    public function getAllSingers() {
        $sql = "SELECT * FROM Singer";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
