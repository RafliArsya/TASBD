<?php 
include 'config.php';

if(isset($_SESSION['status']) && $_SESSION['status'] == TRUE){
	header("location:admin/index2.php");
}else{
	header("location:admin/index2.php");
}
?>