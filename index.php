<?php
session_start();
    if(isset($_SESSION['id'])){
        header("Location: profile.php");
        die();
    }
    else{
        header("Location: login.php");
        die();
    }

?>