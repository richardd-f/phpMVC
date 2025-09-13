<?php
require_once "Database.php";

class Music {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function addMusic($title, $duration, $published) {
        $sql = "INSERT INTO Music (title, duration, published) VALUES (:title, :duration, :published)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':duration' => $duration,
            ':published' => $published
        ]);
    }

    public function assignSinger($music_id, $singer_id) {
        $sql = "UPDATE Music SET singer_id = :singer_id WHERE music_id = :music_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':singer_id' => $singer_id,
            ':music_id' => $music_id
        ]);
    }

    public function getAllMusic() {
        $sql = "SELECT * FROM Music";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
