<?php 
include '../config.php';

// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if(!(isset($_SESSION['status'])) && $_SESSION['status'] != TRUE){
	header("location:../index.php");
}

if(isset($_SESSION['weapon'])){
	unset($_SESSION['weapon']);
}

if(isset($_SESSION['char_id'])){
	unset($_SESSION['char_id']);
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
// menampilkan pesan selamat datang
echo "Hai, selamat datang ". $_SESSION['user_name'];

if(isset($_SESSION['modify_char'])){
	switch ($_SESSION['modify_char']) {
		case "0":
			echo "\n Error Delete Enemy";
		  break;
		case "1":
			echo "\n Successfully Delete Enemy";
		  break;
		case "2":
			echo "\n Successfully Update Enemy";
		  break;
		case "3":
			echo "\n Error Update Enemy";
		  break;
		default:
			echo "ERROR: UNKNOWN COMMAND";
		break;
	} 
	unset($_SESSION['modify_char']);
}

?>
<head>
	<link rel="stylesheet" href="../style.css">
</head>
<body>
	<div class="topnav">
		<a class="active" href="index.php">Enemies</a>
		<a href="index2.php">Weapon</a>
		<a href="index5.php">Weapon [Edit]</a>
		<a href="index4.php">Weapon Mods [Edit]</a>
		<a href="index3.php">About</a>
		<div class="right_nav">
			<a href="logout.php">Log Out</a>
		</div>
	</div> 
	<a href='index_add.php'>Add New Enemy</a>
	<table width='80%' border=1 class="table">
	<tr>
		<th>Name</th>
		<th>Health</th>
		<th>Special</th>
		<th>Armor/Face Plate</th>
		<th>Shield</th>
		<th>Modify</th>
	</tr>
	<?php  
	$result = mysqli_query($conn, "SELECT * FROM enemy_char ORDER BY id ASC");
    while($enemy = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$enemy['char_name']."</td>";
        echo "<td>".$enemy['dmg']."</td>";
		echo "<td>".$enemy['spesial']."</td>";    
		echo "<td>".$enemy['faceplate']."</td>";    
		echo "<td>".$enemy['shield']."</td>";   
		echo "<td><a href='index_edit.php?id=$enemy[id]'>Edit</a> | <a href='delete.php?deletedb=1&dataid=$enemy[id]'>Delete</a></td>";   
		echo "</tr>";
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