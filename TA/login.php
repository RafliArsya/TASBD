<?php 
include 'config.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' and password='$password'");
$cek = mysqli_num_rows($login);
//if ($result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' and password='$password'")) {
//	echo "Returned rows are: " . mysqli_num_rows($result);
	// Free result set
//	mysqli_free_result($result);
//}

if($cek > 0){
	session_destroy();
	session_start();
	$user_data = mysqli_fetch_array($login);
	$_SESSION['username'] = $user_data['username'];
	$_SESSION['user_name'] = $user_data['user_name'];
	$_SESSION['status'] = TRUE;
	header("location:admin/index.php");
}else{
	unset($_SESSION['status']);
	echo "Wrong password";
	header("location:index.php");
}

?>