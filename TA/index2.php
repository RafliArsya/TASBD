<?php 
include 'config.php';

// mengaktifkan session
session_start();

if(isset($_SESSION['status']) && $_SESSION['status'] == TRUE){
	header("location:admin/index2.php");
}

if (isset($_POST['weaponselect'])) {
	unset($_SESSION['weapon']);
	$_SESSION['weapon'] = $_POST['weaponselect'];
	unset($_POST['weaponselect']);
	unset($_POST['weaponmodsselect']);
	unset($_SESSION['weaponmods']);
}
// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
?>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="topnav">
	<a href="index.php">Enemies</a>
	<a class="active" href="index2.php">Weapon</a>
	<a href="index3.php">About</a>
	<div class="right_nav">
		<a href="loginpage.php">Login</a>
	</div>
</div> 
<div class="main">
<form method="post">
Select Weapon : <select name="weaponselect" id="weaponselect" onchange="this.form.submit()">
	<option disabled<?php if(!(isset($_SESSION['weapon']))) {?> selected <?php }?>> Select </option>
	<?php  
	$result = mysqli_query($conn, "SELECT * FROM weapon_table ORDER BY weapon_id ASC");
    while($weapon = mysqli_fetch_array($result)) {
	?>      
        <option value="<?=$weapon['weapon_id']?>" <?php if(isset($_SESSION['weapon']) && $weapon['weapon_id'] == $_SESSION['weapon']){?>selected <?php }?> ><?=$weapon['weapon_name']?></option>
	<?php
	}
	?>
</select>
</form>
</div>
<?php
	if (isset($_POST['weaponmodsselect'])) {
		$_SESSION['weaponmods'] = $_POST['weaponmodsselect'];
		unset($_POST['weaponmodsselect']);
	}
	if (isset($_SESSION['weapon'])){
		$weaponselect = $_SESSION['weapon'];
		$modavailable = mysqli_query($conn, "SELECT * FROM `weapon_weaponmods` as A inner join weapon_table as B ON B.weapon_id = A.weapon_id inner join weaponmods_table as C ON C.weaponmods_id = A.weaponmods_id WHERE A.weapon_id = $weaponselect")
		?><form method="post">
		Select Mods : <select name="weaponmodsselect" id="weaponmodsselect" onchange="this.form.submit()">
		<option value="0"<?php if(!(isset($_SESSION['weaponmods']))) {?> selected <?php }?>> unselect </option>
		<?php  
    		while($weaponmods = mysqli_fetch_array($modavailable)) {
		?>      
    		<option value="<?=$weaponmods['id']?>" <?php if(isset($_SESSION['weaponmods']) && $weaponmods['id'] == $_SESSION['weaponmods']){?>selected <?php }?> ><?=$weaponmods['weaponmods_name']?></option>
		<?php
		}
		?>
		</select>
		</form>
		<?php
		//echo $_POST['weaponselect'];
		$weapon_result = mysqli_query($conn, "SELECT * FROM weapon_table WHERE weapon_id = $weaponselect");
		$wsel = mysqli_fetch_array($weapon_result);
		?>
		<center><table width='50%' border=1 class="table">
		<tr>
			<th>Name</th>
			<th>Damage</th>
			<th>Armor Piercing</th>
			<th>Shield Piercing</th>
		</tr>
		<?php
		$dmg = $wsel['stats_dmg'];
		if (!(isset($_SESSION['weaponmods']))){
			$modsel = 0;
		}else{
			$modsel = $_SESSION['weaponmods'];
		}
		$modstats = 0;
		if ($modsel > 0) {
			$modselected = mysqli_query($conn, "SELECT * FROM `weapon_weaponmods` as A inner join weapon_table as B ON B.weapon_id = A.weapon_id inner join weaponmods_table as C ON C.weaponmods_id = A.weaponmods_id WHERE A.weapon_id = $weaponselect AND A.id = $modsel");
			$weaponmodselected = mysqli_fetch_array($modselected);
			$modstats = $weaponmodselected['dmg'];
		}
		$dmg = $dmg + $modstats;
    	echo "<tr>";
    	echo "<td>".$wsel['weapon_name']."</td>";
    	echo "<td>".$dmg."</td>";
		echo "<td>".$wsel['stats_piercing']."</td>";    
		echo "<td>".$wsel['stats_shield']."</td></tr>";    
		?>
	</table></center>
	<?php
	}
?>
</body>