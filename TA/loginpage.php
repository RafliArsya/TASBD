<?php 
include 'config.php';

// mengaktifkan session
session_start();

if(isset($_SESSION['status'])){
	header("location:../admin/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payday 2 STATS Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="topnav">
	<a href="index.php">Enemies</a>
	<a href="index2.php">Weapon</a>
	<a href="index3.php">About</a>
	<div class="right_nav">
		<a class="active" href="loginpage.php">Login</a>
	</div>
</div> 
	<br/>
	<br/>
	<center><h2>Login Page</h2></center>	
	<br/>
	<div class="login">
	<br/>
		<form action="login.php" method="post" onSubmit="return validasi()">
			<div>
				<label>Username:</label>
				<input type="text" name="username" id="username" />
			</div>
			<div>
				<label>Password :</label>
				<input type="password" name="password" id="password" />
			</div>			
			<div>
				<input type="submit" value="Login" class="tombol">
			</div>
		</form>
	</div>
</body>

<script type="text/javascript">
	function validasi() {
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;		
		if (username != "" && password!="") {
			return true;
		}else{
			alert('Username dan Password harus di isi !');
			return false;
		}
	}
</script>

</html>