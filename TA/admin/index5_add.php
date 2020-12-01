<?php 
include '../config.php';

// mengaktifkan session
session_start();

if(!(isset($_SESSION['status'])) && $_SESSION['status'] != TRUE){
	header("location:../index5.php");
}
// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
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

    <form action="index5_add.php" method="post" name="Form_index5_add">
        <table width="25%" border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr> 
                <td>Damage</td>
                <td><input type="text" name="dmg" required></td>
            </tr>
            <tr> 
                <td>Shield Piercing</td> 
                <td><input type="text" name="shield"></td>
            </tr>
            <tr> 
                <td>Plate Piercing</td>
                <td><input type="text" name="plate"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
    <?php
        if(isset($_POST['Submit'])) {
            $sp = 0;
            $pl = $sp;
            $name = $_POST['name'];
            $dmg = $_POST['dmg'];
            if(isset($_POST['shield'])){
                $sp = $_POST['shield'];
            }
            if(isset($_POST['plate'])){
                $pl = $_POST['plate'];
            }
            // Insert user data into table
            if($result = mysqli_query($conn, "INSERT INTO weapon_table (`weapon_name`, `stats_dmg`, `stats_shield`, `stats_piercing`) VALUES('$name','$dmg','$sp','$pl')") ) {
                echo "Weapon added successfully. <a href='index5.php'>View Weapon Table</a>";
            }
            unset($_POST['Submit']);
        }
    ?>
</body>