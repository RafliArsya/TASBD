<?php
$servername = "localhost";
$database = "payday";

// Create connection
//if(isset($_SESSION['status'])){
//	$conn = mysqli_connect($servername, 'root', '', $database);
//	$connection = "root";
//} else {
//	$conn = mysqli_connect($servername, 'anonymous', '', $database);
//	$connection = "anon";
//}
$conn = mysqli_connect($servername, 'root', '', $database);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	mysqli_close($conn);
} else {
	echo "Connected successfully\n";
}
?>