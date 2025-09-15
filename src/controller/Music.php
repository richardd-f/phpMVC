<?php
require_once("Util.php"); // pake redirectWith
include("../model/Music.php");
require_once("Util.php");
session_start();

$musicPath = "../view/page/addMusic.php";
/* Convert "mm:ss" string to total seconds */
function parseDuration($timeString) {
    try {
        $timeString = trim($timeString);

        // Case 1: format mm:ss
        if (preg_match('/^\d{1,2}:\d{2}$/', $timeString)) {
            $parts = explode(':', $timeString);
            $minutes = (int)$parts[0];
            $seconds = (int)$parts[1];

            if ($seconds >= 60) {
                return [
                    "success" => false,
                    "err" => "Invalid format: seconds must be less than 60."
                ];
            }

            return [
                "success" => true,
                "data" => ($minutes * 60) + $seconds
            ];
        }

        // Case 2: total detik (angka murni)
        if (ctype_digit($timeString)) {
            return [
                "success" => true,
                "data" => (int)$timeString
            ];
        }

        // Kalau format tidak dikenali
        return [
            "success" => false,
            "err" => "Invalid duration format. Use mm:ss or total seconds."
        ];
    } catch (Exception $e) {
        return [
            "success" => false,
            "err" => $e->getMessage()
        ];
    }
}

/* Create new music */
function createMusic($musicPath) {
    $music = new Music();

    $title = $_POST['title'] ?? '';
    $duration = $_POST['duration'] ?? '0:00';
    $durationInSeconds = parseDuration($duration);
    $publishDate = $_POST['publishDate'] ?? null;

    // check parseDuration status, if error redirect
    if(!$durationInSeconds["success"]){
        redirectWith($musicPath,[
            "err" => $durationInSeconds["err"]
        ]);
    }

    $status = $music->addMusic($title, $durationInSeconds["data"], $publishDate);
    if (!$status["success"]) {
        redirectWith($musicPath, [
            "err" => $status["err"] ?? "Failed to add music"
        ]);
    }
    return true;
}

/* Update music */
function updateMusic() {
    $music = new Music();

    $music_id = $_POST['music_id'] ?? null;
    $title = $_POST['title'] ?? '';
    $duration = $_POST['duration'] ?? '0:00';
    $durationInSeconds = parseDuration($duration);    
    $publishDate = $_POST['publishDate'] ?? null;
    var_dump($music_id, $title, $durationInSeconds, $publishDate);
    die();

    if (!$music_id) {
        return [
            "success" => false,
            "err" => "Music ID not provided"
        ];
    }

    return $music->updateMusic($music_id, $title, $durationInSeconds, $publishDate);
}

/* Routing actions */
if (isset($_POST['addmusic_button'])) {
    if (createMusic($musicPath)) {
        // header("Location: ../view/page/addMusic.php?success=1");
        redirectWith($musicPath, [
            "msg" =>  "Music Added !!!"
        ]);
    } else {
        // header("Location: ../view/page/addMusic.php?error=1");
        redirectWith($musicPath, [
            "err" => "Failed to add music !!!"
        ]);
    }
    exit;
}

if (isset($_POST['editmusic_button'])) {
    if (updateMusic()) {
        // header("Location: ../view/page/addMusic.php?success=2"); // success=2 = updated
        redirectWith($musicPath, [
            "msg" => "Music Updated !!!"
        ]);
    } else {
        // header("Location: ../view/page/addMusic.php?error=1");
        redirectWith($musicPath, [
            "err" => "Failed to updated music !!!"
        ]);
    }
    exit;
}

/* Delete music */
function deleteMusic() {
    $music = new Music();

    $music_id = $_GET['musicId'] ?? null; // pakai GET
    if (!$music_id) {
        return [
            "success" => false,
            "err" => "No music ID provided"
        ];
    }

    return $music->deleteMusic($music_id);
}

/* Routing actions */

// Add music
if (isset($_POST['addmusic_button'])) {
    $result = createMusic($musicPath);

    if ($result["success"]) {
        redirectWith("../view/page/addMusic.php", ["success" => 1]); // added
    } else {
        redirectWith("../view/page/addMusic.php", ["error" => $result["err"] ?? "Failed to add music"]);
    }
}

// Edit music
if (isset($_POST['editmusic_button'])) {
    if ($result["success"]) {
        redirectWith("../view/page/addMusic.php", ["success" => 2]); // updated
    } else {
        redirectWith("../view/page/addMusic.php", ["error" => $result["err"] ?? "Failed to update music"]);
    }
}

// Delete music
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['musicId'])) {
    $result = deleteMusic();

    if ($result["success"]) {
        header("Location: ../view/page/addMusic.php?success=3"); // success=3 = deleted
    } else {
        header("Location: ../view/page/addMusic.php?error=1");
    }
}

if(isset($_GET["action"])){
    if($_GET["action"] == "edit" && isset($_GET["id"])){
        $id = $_GET["id"];
        $statusQuery =  $music->getMusicById($id);

        if(!$statusQuery["success"]){
            redirectWith($musicPath, [
                "err" => $statusQuery["err"]
            ]);
        }

        redirectWith($musicPath, array_merge(
            ["action" => "edit"],
            $statusQuery["data"]
        ));
    }
}