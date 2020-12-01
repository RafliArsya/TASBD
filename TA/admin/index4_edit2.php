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
    $id = $_SESSION['weapavail_id'];
    $weapid=$_POST['weap_id'];
    $weapmods=$_POST['weapmods_id'];

    // update user data
    if($result = mysqli_query($conn, "UPDATE weapon_weaponmods SET weapon_id='$weapid', weaponmods_id='$weapmods' WHERE id=$id")){
        $_SESSION['modify_availmods'] = 2;
    } else {
        $_SESSION['modify_availmods'] = 3;
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
    $_SESSION['weapavail_id'] = $id;
}
if (!(isset($_GET['id'])) && isset($_SESSION['weapavail_id'])){
    $id = $_SESSION['weapavail_id'];
}
// Fetech user data based on id
$result = mysqli_query($conn, "SELECT * FROM weapon_weaponmods WHERE id=$id");

while($data = mysqli_fetch_array($result))
{
    $weapid = $data['weapon_id'];
    $weapmods = $data['weaponmods_id'];
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
        <table class="table" border=0>
            <tr>
                <td>
                    Weapon Id
                </td>
                <td>
                    Weaponmods Id
                </td>
        </tr>
        <tr>
                <td>
            <table border=1 class="table">
	            <tr>
	        	    <th>Weapon Name</th>
	        	    <th>Weapon id</th>
	            </tr>
	            <?php  
	                $resulta = mysqli_query($conn, "SELECT * FROM weapon_table ORDER BY weapon_id ASC");
                    while($weaponlist = mysqli_fetch_array($resulta)) {         
                        echo "<tr>";
                        echo "<td>".$weaponlist['weapon_name']."</td>";
                        echo "<td>".$weaponlist['weapon_id']."</td>";
                        echo "</tr>";        
	                }
                ?>
            </table>
                </td>
                <td>
            <table border=1 class="table">
	            <tr>
	    	       <th>Weaponmods Name</th>
	    	       <th>Weaponmods id</th>
	            </tr>
	            <?php  
	                $resultb = mysqli_query($conn, "SELECT * FROM weaponmods_table ORDER BY weaponmods_id ASC");
                    while($weaponmodlist = mysqli_fetch_array($resultb)) {         
                        echo "<tr>";
                        echo "<td>".$weaponmodlist['weaponmods_name']."</td>";
                        echo "<td>".$weaponmodlist['weaponmods_id']."</td>";
                        echo "</tr>";        
	                }
                 ?>
            </table>
                </td>
        </table>
    <form action="index4_edit2.php" method="post" name="Form_index42_update">
        <table width="25%" border="0">
            <tr> 
                <td>Weapon ID</td>
                <td><input type="text" name="weap_id" required value="<?php echo $weapid;?>"></td>
            </tr>
            <tr> 
                <td>Weapon Mods ID</td>
                <td><input type="text" name="weapmods_id" required value="<?php echo $weapmods;?>"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>