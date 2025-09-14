<?php
include("../model/Music.php");
session_start();

function createMusic() {
    $music = new Music();
    
    // Get form data
    $title = $_POST['title'];
    $duration = $_POST['duration'];
    $published = $_POST['published'];
    
    // Save directly to database
    $result = $music->addMusic($title, $duration, $published);
    
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