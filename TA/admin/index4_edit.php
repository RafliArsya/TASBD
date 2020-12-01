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
    $id = $_SESSION['weapmods_id'];
    $name=$_POST['name'];
    $dmg=$_POST['dmg'];
    $type=$_POST['type'];

    // update user data
    if($result = mysqli_query($conn, "UPDATE weaponmods_table SET weaponmods_name='$name', type='$type', dmg='$dmg', WHERE weaponmods_id=$id")){
        $_SESSION['modify_weapmod'] = 2;
    } else {
        $_SESSION['modify_weapmod'] = 3;
    }
    unset($_POST['update']);
    header("Location: index4.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $_SESSION['weapmods_id'] = $id;
}
if (!(isset($_GET['id'])) && isset($_SESSION['weapmods_id'])){
    $id = $_SESSION['weapmods_id'];
}
// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM weaponmods_table WHERE weaponmods_id=$id");

while($data = mysqli_fetch_array($result))
{
    $name = $data['weaponmods_name'];
    $dmg = $data['dmg'];
    $type = $data['type'];
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
	<a href="index5.php">Weapon [Edit]</a>
	<a class="active" href="index4.php">Weapon Mods [Edit]</a>
	<a href="index3.php">About</a>
	<div class="right_nav">
		<a href="logout.php">Log Out</a>
	</div>
</div> 

    <form action="index4_edit.php" method="post" name="Form_index4_update">
        <table width="25%" border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" required value="<?php echo $name;?>"></td>
            </tr>
            <tr> 
                <td>Type</td>
                <td><input type="text" name="type" required value="<?php echo $type;?>"></td>
            </tr>
            <tr> 
                <td>Damage</td>
                <td><input type="text" name="dmg" required value="<?php echo $dmg;?>"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>