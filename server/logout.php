<?php 
    session_start();
    unset($_SESSION["Email"]);
    unset($_SESSION["Access"]);
    header("Location:../index.php");
?>