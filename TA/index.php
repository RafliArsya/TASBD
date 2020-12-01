<?php 
include 'config.php';

// mengaktifkan session
session_start();

if(isset($_SESSION['status']) && $_SESSION['status'] == TRUE){
	header("location:admin/index.php");
}

if(isset($_SESSION['weapon'])){
	unset($_SESSION['weapon']);
}

if (isset($_POST['enemyselect'])) {
	unset($_SESSION['enemyselect']);
	$_SESSION['enemyselect'] = $_POST['enemyselect'];
	unset($_POST['enemyselect']);
}

if (isset($_SESSION['enemyselect']) && $_SESSION['enemyselect'] > 0 ) {
	$id = $_SESSION['enemyselect'];
	$resultx = mysqli_query($conn, "SELECT char_name FROM enemy_char where id = $id");
	$w = mysqli_fetch_array($resultx);
	$_SESSION['enemy_char_select'] = $w['char_name'];
}else{
	unset($_SESSION['enemyselect']);
	if(isset($_SESSION['enemy_char_select'])){
		unset($_SESSION['enemy_char_select']);
	}
}

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
?>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="topnav">
		<a class="active" href="index.php">Enemies</a>
		<a href="index2.php">Weapon</a>
		<a href="index3.php">About</a>
		<div class="right_nav">
			<a href="loginpage.php">Log In</a>
		</div>
	</div> 
	<table width='80%' border=1 class="table">
	<tr>
		<th>Name</th>
		<th>Health</th>
		<th>Special</th>
		<th>Armor/Face Plate</th>
		<th>Shield</th>
	</tr>
	<?php  
	$result = mysqli_query($conn, "SELECT * FROM enemy_char ORDER BY id ASC");
    while($enemy = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$enemy['char_name']."</td>";
        echo "<td>".$enemy['dmg']."</td>";
		echo "<td>".$enemy['spesial']."</td>";    
		echo "<td>".$enemy['faceplate']."</td>";    
		echo "<td>".$enemy['shield']."</td></tr>";   
    }
	?>
	</table>
	<p>Show One Hit Kill</p>
	<form method="post">
		Enemy : <select name="enemyselect" id="enemyselect" onchange="this.form.submit()">
		<option <?php if(!(isset($_SESSION['enemyselect']))) {?> selected <?php }?>> Select </option>
		<?php  
			$resultz = mysqli_query($conn, "SELECT * FROM enemy_char ORDER BY id ASC");
    		while($enemy = mysqli_fetch_array($resultz)) {
		?>      
        <option value="<?=$enemy['id']?>" <?php if(isset($_SESSION['enemyselect']) && $enemy['id'] == $_SESSION['enemyselect']){?>selected <?php }?> ><?=$enemy['char_name']?></option>
	<?php
	}
	?>
	</select>
	</form>
	<?php if(isset($_SESSION['enemyselect']) && $_SESSION['enemyselect'] > 0) {?>
	<table width='80%' border=1 class="table">
	<tr>
		<th>Weapon</th>
		<th>Damage</th>
	</tr>
	<?php  
		$name = $_SESSION['enemy_char_select'];
		$resultz = mysqli_query($conn, "SELECT * FROM view_ohk where char_name = '$name'");
    	while($ohk = mysqli_fetch_array($resultz)) {
			echo "<tr>";
			echo "<td>".$ohk['weapon_name']."</td>";
			echo "<td>".$ohk['stats_dmg']."</td></tr>";
		}
	?>
	</table>
	<?php 
	} ?>
</body>