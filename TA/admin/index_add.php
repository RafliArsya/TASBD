<?php 
include '../config.php';

// mengaktifkan session
session_start();

if(!(isset($_SESSION['status'])) && $_SESSION['status'] != TRUE){
	header("location:../index.php");
}
// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
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

    <form action="index_add.php" method="post" name="Form_index_add">
        <table width="25%" border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr> 
                <td>Health</td>
                <td><input type="text" name="hp" required></td>
            </tr>
            <tr> 
                <td>Special</td> 
                <td><input type="text" name="sp"></td>
            </tr>
            <tr> 
                <td>Shield</td>
                <td><input type="text" name="shield"></td>
            </tr>
            <tr> 
                <td>Armorplate / Faceplate</td>
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
            $sh = $sp;
            $pl = $sh;
            $name = $_POST['name'];
            $hp = $_POST['hp'];
            if(isset($_POST['sp'])){
                $sp = $_POST['sp'];
            }
            if(isset($_POST['shield'])){
                $sh = $_POST['shield'];
            }
            if(isset($_POST['plate'])){
                $pl = $_POST['plate'];
            }
            // Insert user data into table
            if($result = mysqli_query($conn, "INSERT INTO enemy_char (`char_name`, `dmg`, `spesial`, `faceplate`, `shield`) VALUES('$name','$hp','$sp','$sh','$pl')") ) {
                echo "Enemy added successfully. <a href='index.php'>View Enemy Table</a>";
            }
            unset($_POST['Submit']);
        }
    ?>
</body>