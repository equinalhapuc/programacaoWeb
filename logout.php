<?php
    session_start();
    unset($_SESSION['userId']);
    unset($_SESSION['nome']);
    session_unset();
    session_destroy();
    header('Location: login.php');
?>