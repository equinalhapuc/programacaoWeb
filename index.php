<?php
    session_start();
    
    if(!isset($_SESSION['valid'])) {
        header("Location: login.php");
    }
    else {
        header("Location: home.php");
    }
?>