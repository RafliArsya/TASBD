<?php 
unset($_SESSION['status']);
session_start();
session_destroy();
header("location:../index.php");
?>