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
            try {
            $sql = "INSERT INTO Music (title, duration, publishDate) VALUES (:title, :duration, :publishDate)";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':title' => $title,
                ':duration' => $duration,
                ':publishDate' => $publishDate
            ]);
            return [
                "success" => true,
                "err" => null
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "err" => $e->getMessage()
            ];
        }
    }

    // Assign Singer to Music
    public function assignSinger($music_id, $singer_id) {
        try {
            $sql = "UPDATE Music SET singer_id = :singer_id WHERE music_id = :music_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':singer_id' => $singer_id,
                ':music_id' => $music_id
            ]);

            return [
                "success" => true,
                "err" => null
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "err" => $e->getMessage()
            ];
        }
    }

    // Read Music
    public function getAllMusic() {
        try {
            $sql = "SELECT * FROM Music";
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                "success" => true,
                "data" => $data,
                "err" => null
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "data" => null,
                "err" => $e->getMessage()
            ];
        }
    }

    // get all music that is ASSIGNED to singer
    public function getAllAssignedMusics() {
        try {
            $sql = "SELECT 
                        m.music_id, 
                        m.title AS music_title, 
                        m.duration, 
                        m.publishDate,
                        s.singer_id,
                        s.name AS singer_name
                    FROM Music m
                    INNER JOIN Singer s ON m.singer_id = s.singer_id";
            
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                "success" => true,
                "data" => $data,
                "err" => null
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "data" => null,
                "err" => $e->getMessage()
            ];
        }
    }

    // get all music that is NOT ASSIGNED
    public function getAllNotAssignedMusics(){
        try {
            $sql = "SELECT * FROM Music WHERE singer_id IS NULL";
            
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                "success" => true,
                "data" => $data,
                "err" => null
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "data" => null,
                "err" => $e->getMessage()
            ];
        }
    }

    public function getMusicById($music_id) {
        try {
        $sql = "SELECT * FROM Music WHERE music_id = :music_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':music_id' => $music_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

            return [
                "success" => true,
                "data" => $data,
                "err" => null
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "data" => null,
                "err" => $e->getMessage()
            ];
        }
    }

    // Update Music
    public function updateMusic($music_id, $title, $duration, $publishDate, $singer_id = null) {
        try {
            $sql = "UPDATE Music 
                    SET title = :title, duration = :duration, publishDate = :publishDate, singer_id = :singer_id
                    WHERE music_id = :music_id";

            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute([
                ':title' => $title,
                ':duration' => $duration,
                ':publishDate' => $publishDate,
                ':singer_id' => $singer_id,
                ':music_id' => $music_id
            ]);

            return [
                "success" => $success,
                "data" => $success ? $this->getMusicById($music_id) : null,
                "err" => $success ? null : "Failed to update music"
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "data" => null,
                "err" => $e->getMessage()
            ];
        }
    }

    // Update assigned singer
    public function updateSinger($music_id, $old_singer_id, $new_singer_id) {
        try {
            $stmt = $this->conn->prepare("UPDATE music_singer SET singer_id=? WHERE music_id=? AND singer_id=?");
            $stmt->execute([$new_singer_id, $music_id, $old_singer_id]);
            return ["success" => true];
        } catch (Exception $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    // Delete assigned singer
    public function unassignSinger($music_id) {
        try {
            $sql = "UPDATE Music SET singer_id = NULL WHERE music_id = :music_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':music_id' => $music_id]);

            return [
                "success" => true,
                "err" => null
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "err" => $e->getMessage()
            ];
        }
    }

    // Delete Music
    public function deleteMusic($music_id) {
        try {
            $sql = "DELETE FROM Music WHERE music_id = :music_id";
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute([':music_id' => $music_id]);

            return [
                "success" => $success,
                "data" => null, // delete biasanya ga return data
                "err" => $success ? null : "Failed to delete music"
            ];
        } catch (PDOException $e) {
            return [
                "success" => false,
                "data" => null,
                "err" => $e->getMessage()
            ];
        }
    }

    
}
