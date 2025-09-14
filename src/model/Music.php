<?php
require_once "Database.php";

class Music {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    // CRUD operations for Music
    // Create Music
    public function addMusic($title, $duration, $publishDate) {
        $sql = "INSERT INTO Music (title, duration, publishDate) VALUES (:title, :duration, :publishDate)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':duration' => $duration,
            ':publishDate' => $publishDate
        ]);
    }

    // Assign Singer to Music
    public function assignSinger($music_id, $singer_id) {
        $sql = "UPDATE Music SET singer_id = :singer_id WHERE music_id = :music_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':singer_id' => $singer_id,
            ':music_id' => $music_id
        ]);
    }

    // Read Music
    public function getAllMusic() {
        $sql = "SELECT * FROM Music";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMusicById($music_id) {
        $sql = "SELECT * FROM music WHERE music_id = :music_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':music_id' => $music_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update Music

    // Delete Music
    public function deleteMusic($music_id) {
        $sql = "DELETE FROM music WHERE music_id = :music_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':music_id' => $music_id]);
    }

    
}
