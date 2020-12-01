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

if(isset($_SESSION['modify_weap'])){
	switch ($_SESSION['modify_weap']) {
		case "0":
			echo "\n Error Delete Weapon";
		  break;
		case "1":
			echo "\n Successfully Delete Weapon";
		  break;
		case "2":
			echo "\n Successfully Update Weapon";
		  break;
		case "3":
			echo "\n Error Update Weapon";
		  break;
		default:
			echo "ERROR: UNKNOWN COMMAND";
		break;
	} 
	unset($_SESSION['modify_weap']);
}
?>
<head>
	<link rel="stylesheet" href="../style.css">
</head>
<body>
	<div class="topnav">
		<a href="index.php">Enemies</a>
		<a href="index2.php">Weapon</a>
		<a class="active" href="index5.php">Weapon [Edit]</a>
		<a href="index4.php">Weapon Mods [Edit]</a>
		<a href="index3.php">About</a>
		<div class="right_nav">
			<a href="logout.php">Log Out</a>
		</div>
	</div> 
	<a href='index5_add.php'>Add New Weapon</a>
	<table width='80%' border=1 class="table">
	<tr>
		<th>Name</th>
		<th>Damage</th>
		<th>Armor Piercing</th>
		<th>Shield Piercing</th>
		<th>Modify</th>
	</tr>
	<?php  
	$result = mysqli_query($conn, "SELECT * FROM weapon_table ORDER BY weapon_id ASC");
    while($weapon = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$weapon['weapon_name']."</td>";
        echo "<td>".$weapon['stats_dmg']."</td>";
		echo "<td>".$weapon['stats_piercing']."</td>";    
		echo "<td>".$weapon['stats_shield']."</td>";    
		echo "<td><a href='index5_edit.php?id=$weapon[weapon_id]'>Edit</a> | <a href='delete.php?deletedb=2&dataid=$weapon[weapon_id]'>Delete</a></td>";     
		echo "</tr>";   
    }
    ?>
	</table>
</body>