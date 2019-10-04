<?php
session_start();
ob_start();

if($_SESSION["access_status"] != true){
    header("Location: ../login.php");
    exit;
}
?>