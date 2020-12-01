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
    $id = $_SESSION['char_id'];
    $name=$_POST['name'];
    $hp=$_POST['hp'];
    $sp=$_POST['sp'];
    $sh=$_POST['shield'];
    $pl=$_POST['plate'];

    // update user data
    if($result = mysqli_query($conn, "UPDATE enemy_char SET char_name='$name',dmg='$hp',spesial='$sp',faceplate='$pl',shield='$sh' WHERE id=$id")){
        $_SESSION['modify_char'] = 2;
    } else {
        $_SESSION['modify_char'] = 3;
    }
    unset($_POST['update']);
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $_SESSION['char_id'] = $id;
}
if (!(isset($_GET['id'])) && isset($_SESSION['char_id'])){
    $id = $_SESSION['char_id'];
}
// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM enemy_char WHERE id=$id");

while($data = mysqli_fetch_array($result))
{
    $name = $data['char_name'];
    $hp = $data['dmg'];
    $sp = $data['spesial'];
    $sh = $data['shield'];
    $pl = $data['faceplate'];
}
?>
<html>
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

    <form action="index_edit.php" method="post" name="Form_index_update">
        <table width="25%" border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" required value="<?php echo $name;?>"></td>
            </tr>
            <tr> 
                <td>Health</td>
                <td><input type="text" name="hp" required value="<?php echo $hp;?>"></td>
            </tr>
            <tr> 
                <td>Special</td> 
                <td><input type="text" name="sp" value="<?php echo $sp;?>"></td>
            </tr>
            <tr> 
                <td>Shield</td>
                <td><input type="text" name="shield" value="<?php echo $sh;?>"></td>
            </tr>
            <tr> 
                <td>Armorplate / Faceplate</td>
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