<?php 
include '../config.php';

// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if(!(isset($_SESSION['status'])) && $_SESSION['status'] != TRUE){
	header("location:../index2.php");
}

// menampilkan pesan selamat datang
echo "Hai, selamat datang ". $_SESSION['user_name'];

if(isset($_SESSION['modify_weapmods'])){
	switch ($_SESSION['modify_weapmods']) {
		case "0":
			echo "\n Error Delete Weapon Mods";
		  break;
		case "1":
			echo "\n Successfully Delete Weapon Mods";
		  break;
		case "2":
			echo "\n Successfully Update Weapon Mods";
		  break;
		case "3":
			echo "\n Error Update Weapon Mods";
		  break;
		default:
			echo "ERROR: UNKNOWN COMMAND";
		break;
	} 
	unset($_SESSION['modify_weapmods']);
}

if(isset($_SESSION['modify_availmods'])){
	switch ($_SESSION['modify_availmods']) {
		case "0":
			echo "\n Error Delete Available Weapon Mods";
		  break;
		case "1":
			echo "\n Successfully Delete Available Weapon Mods";
		  break;
		case "2":
			echo "\n Successfully Update Available Weapon Mods";
		  break;
		case "3":
			echo "\n Error Update Available Weapon Mods";
		  break;
		default:
			echo "ERROR: UNKNOWN COMMAND";
		break;
	} 
	unset($_SESSION['modify_availmods']);
}

?>
<head>
	<link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="topnav">
		<a href="index.php">Enemies</a>
		<a href="index2.php">Weapon</a>
		<a href="index5.php">Weapon [Edit]</a>
		<a class="active" href="index4.php">Weapon Mods [Edit]</a>
		<a href="index3.php">About</a>
		<div class="right_nav">
			<a href="logout.php">Log Out</a>
		</div>
	</div> 
	<p> Weapon Mods List </p>
	<a href='index4_add.php'>Add New Weapon</a>
	<table width='80%' border=1 class="table">
	<tr>
		<th>Name</th>
		<th>Type</th>
		<th>Damage</th>
		<th>Modify</th>
	</tr>
	<?php  
	$result = mysqli_query($conn, "SELECT * FROM weaponmods_table ORDER BY weaponmods_id ASC");
    while($weaponmods = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$weaponmods['weaponmods_name']."</td>";
        echo "<td>".$weaponmods['type']."</td>";
		echo "<td>".$weaponmods['dmg']."</td>"; 
        echo "<td><a href='index4_edit.php?id=$weaponmods[weaponmods_id]'>Edit</a> | <a href='delete.php?deletedb=3&dataid=$weaponmods[weaponmods_id]'>Delete</a></td></tr>";        
	}
	?>
	</table>
	<p> Weapon Available Weaponmods </p>
	<a href='index4_add2.php'>Add New Available Mods</a>
	<table width='80%' border=1 class="table">
	<tr>
		<th>Weapon Name</th>
		<th>Weapon Mods</th>
		<th>Modify</th>
	</tr>
	<?php
	$mods = mysqli_query($conn, "SELECT * FROM `weapon_weaponmods` as A inner join weapon_table as B ON B.weapon_id = A.weapon_id inner join weaponmods_table as C ON C.weaponmods_id = A.weaponmods_id");
	while($weaponmod = mysqli_fetch_array($mods)) {         
        echo "<tr>";
		echo "<td>".$weaponmod['weapon_name']."</td>";
		echo "<td>".$weaponmod['weaponmods_name']."</td>";
        echo "<td><a href='index4_edit2.php?id=$weaponmod[id]'>Edit</a> | <a href='delete.php?deletedb=4&dataid=$weaponmod[id]'>Delete</a></td></tr>";        
	}
    ?>
	</table>
</body>