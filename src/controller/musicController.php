<?php
include("../model/Music.php");
session_start();

/* Convert "mm:ss" string to total seconds */
function parseDuration($timeString) {
    $parts = explode(':', $timeString);
    if (count($parts) === 2) {
        $minutes = (int)$parts[0];
        $seconds = (int)$parts[1];
        return ($minutes * 60) + $seconds;
    }
    return (int)$timeString; // fallback kalau misalnya user input "120"
}

/* Create new music */
function createMusic() {
    $music = new Music();

    $title = $_POST['title'] ?? '';
    $duration = $_POST['duration'] ?? '0:00';
    $durationInSeconds = parseDuration($duration);
    $publishDate = $_POST['publishDate'] ?? null;

    return $music->addMusic($title, $durationInSeconds, $publishDate);
}

/* Update music */
function updateMusic() {
    $music = new Music();

    $music_id = $_POST['music_id'] ?? null;
    $title = $_POST['title'] ?? '';
    $duration = $_POST['duration'] ?? '0:00';
    $durationInSeconds = parseDuration($duration);
    $publishDate = $_POST['publishDate'] ?? null;

    if (!$music_id) {
        return false;
    }

    return $music->updateMusic($music_id, $title, $durationInSeconds, $publishDate);
}

/* Routing actions */
if (isset($_POST['addmusic_button'])) {
    if (createMusic()) {
        header("Location: ../view/page/addMusic.php?success=1");
    } else {
        header("Location: ../view/page/addMusic.php?error=1");
    }
    exit;
}

if (isset($_POST['editmusic_button'])) {
    if (updateMusic()) {
        header("Location: ../view/page/addMusic.php?success=2"); // success=2 = updated
    } else {
        header("Location: ../view/page/addMusic.php?error=1");
    }
    exit;
}

/* Delete music */
function deleteMusic() {
    $music = new Music();

    $music_id = $_GET['musicId'] ?? null; // use GET instead of POST
    if (!$music_id) {
        return [
            "success" => false,
            "err" => "No music ID provided"
        ];
    }

    return $music->deleteMusic($music_id);
}

// Handle GET delete (from ?action=delete&musicId=...)
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['musicId'])) {
    $result = deleteMusic();

    if ($result["success"]) {
        header("Location: ../view/page/addMusic.php?success=3"); // success=3 = deleted
    } else {
        header("Location: ../view/page/addMusic.php?error=1");
    }
    exit;
}

