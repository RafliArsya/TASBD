<?php 
include '../config.php';

// mengaktifkan session
session_start();

if(!(isset($_SESSION['status'])) && $_SESSION['status'] != TRUE){
	header("location:../index3.php");
}
// cek apakah user telah login, jika belum login maka di alihkan ke halaman login

if(isset($_SESSION['weapon'])){
	unset($_SESSION['weapon']);
}
?>
<head>
	<link rel="stylesheet" href="../style.css">
</head>
<div class="topnav">
	<a href="index.php">Enemies</a>
	<a href="index2.php">Weapon</a>
	<a href="index5.php">Weapon [Edit]</a>
	<a href="index4.php">Weapon Mods [Edit]</a>
	<a class="active" href="index3.php">About</a>
	<div class="right_nav">
		<a href="logout.php">Log Out</a>
	</div>
</div> 
<h2>
	<p>Contact: Rafli</p>
</h2>
