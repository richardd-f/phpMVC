<?php
include("../model/Music.php");
session_start();

function createMusic() {
    $music = new Music();
    
    // Get form data
    $title = $_POST['title'];
    $duration = $_POST['duration'];// Convert "mm:ss" to seconds
    list($minutes, $seconds) = explode(':', $_POST['duration']);
    $durationInSeconds = ($minutes * 60) + $seconds;
    
    $publishDate = $_POST['publishDate'];
    
    // Save directly to database
    $result = $music->addMusic($_POST['title'], $durationInSeconds, $_POST['publishDate']);

    
    return $result;
}

if (isset($_POST['addmusic_button'])) {
    if (createMusic()) {
        // Success
        header("Location: ../view/page/addMusic.php?success=1");
    } else {
        // Error
        header("Location: ../view/page/addMusic.php?error=1");
    }
    exit;
}
?>