<?php 
include '../config.php';

// mengaktifkan session
session_start();

if(!(isset($_SESSION['status'])) && $_SESSION['status'] != TRUE){
	header("location:../index4.php");
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
	<a href="index5.php">Weapon [Edit]</a>
	<a class="active" href="index4.php">Weapon Mods [Edit]</a>
	<a href="index3.php">About</a>
	<div class="right_nav">
		<a href="logout.php">Log Out</a>
	</div>
</div> 

    <form action="index4_add.php" method="post" name="Form_index4_add">
        <table width="25%" border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr> 
                <td>Type</td> 
                <td><input type="text" name="type" required></td>
            </tr>
            <tr> 
                <td>Damage</td>
                <td><input type="text" name="dmg" required></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
    <?php
        if(isset($_POST['Submit'])) {
            $name = $_POST['name'];
            $dmg = $_POST['dmg'];
            $type = $_POST['type'];
            // Insert user data into table
            if($result = mysqli_query($conn, "INSERT INTO weaponmods_table (`weaponmods_name`, `type`, `dmg`) VALUES('$name','$type','$dmg')") ) {
                echo "Weapon Mods added successfully. <a href='index4.php'>View Weapon Mods Table</a>";
            }
            unset($_POST['Submit']);
        }
    ?>
</body>