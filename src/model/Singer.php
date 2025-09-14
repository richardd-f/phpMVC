<?php
require_once "Database.php";

class Singer {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function addSinger($name, $birthdate, $genre, $weight, $height) {
        try {
            $sql = "INSERT INTO Singer (name, birthdate, genre, weight, height) 
                    VALUES (:name, :birthdate, :genre, :weight, :height)";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':name' => $name,
                ':birthdate' => $birthdate,
                ':genre' => $genre,
                ':weight' => $weight,
                ':height' => $height
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

    public function updateSinger($id, $name, $birthdate, $genre, $weight, $height) {
        try {
            $sql = "UPDATE Singer 
                    SET name = :name, birthdate = :birthdate, genre = :genre, weight = :weight, height = :height 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':birthdate' => $birthdate,
                ':genre' => $genre,
                ':weight' => $weight,
                ':height' => $height
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

    function deleteSinger($singerId) {
        try {
            $sql = "DELETE FROM singer WHERE id = :id";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(":id", $singerId, PDO::PARAM_INT);

            $stmt->execute();
            return [
                success => true,
                err => null
            ] ;
        } catch (PDOException $e) {
            return [
                success => false,
                err => $e->getMessage()
            ];
        }
    }

    public function getAllSingers() {
        $sql = "SELECT * FROM Singer";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
