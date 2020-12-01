<?php
// include database connection file
include '../config.php';

// mengaktifkan session
session_start();

if(!(isset($_SESSION['status'])) && $_SESSION['status'] != TRUE){
	header("location:../index.php");
}

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{   
    $id = $_SESSION['weap_id'];
    $name=$_POST['name'];
    $dmg=$_POST['dmg'];
    $sp=$_POST['sp'];
    $pl=$_POST['plate'];

    // update user data
    if($result = mysqli_query($conn, "UPDATE weapon_table SET weapon_name='$name', stats_dmg='$dmg', stats_shield='$sp', stats_piercing='$pl' WHERE weapon_id=$id")){
        $_SESSION['modify_weap'] = 2;
    } else {
        $_SESSION['modify_weap'] = 3;
    }
    unset($_POST['update']);
    header("Location: index5.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $_SESSION['weap_id'] = $id;
}
if (!(isset($_GET['id'])) && isset($_SESSION['weap_id'])){
    $id = $_SESSION['weap_id'];
}
// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM weapon_table WHERE weapon_id=$id");

while($data = mysqli_fetch_array($result))
{
    $name = $data['weapon_name'];
    $dmg = $data['stats_dmg'];
    $sp = $data['stats_shield'];
    $pl = $data['stats_piercing'];
}
?>
<html>
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

    <form action="index5_edit.php" method="post" name="Form_index5_update">
        <table width="25%" border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" required value="<?php echo $name;?>"></td>
            </tr>
            <tr> 
                <td>Damage</td>
                <td><input type="text" name="dmg" required value="<?php echo $dmg;?>"></td>
            </tr>
            <tr> 
                <td>Shield Piercing</td> 
                <td><input type="text" name="sp" value="<?php echo $sp;?>"></td>
            </tr>
            <tr> 
                <td>Plate Piercing</td>
                <td><input type="text" name="plate" value="<?php echo $pl;?>"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>