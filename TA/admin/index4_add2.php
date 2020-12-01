<?php 
include '../config.php';

// mengaktifkan session
session_start();

if(!(isset($_SESSION['status'])) && $_SESSION['status'] != TRUE){
	header("location:../index4.php");
}
?>
<!DOCTYPE html>
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
    <div class="content">
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
                
        <form action="index4_add2.php" method="post" name="Form_index4_add">
            <table width="25%" border="0">
                <tr> 
                    <td>Weapon ID</td>
                    <td><input type="text" name="weap_id" required></td>
                </tr>
                <tr> 
                    <td>Weapon Mod ID</td> 
                    <td><input type="text" name="mod_id" required></td>
                </tr>
                <tr> 
                    <td></td>
                    <td><input type="submit" name="Submit" value="Add"></td>
                </tr>
            </table>
        </form>
    </div>
    <?php 
    if(isset($_POST['Submit'])) {
     $weapid = $_POST['weap_id'];
     $modid = $_POST['mod_id'];
            
    if($result = mysqli_query($conn, "INSERT INTO weapon_weaponmods (`weapon_id`, `weaponmods_id`) VALUES('$weapid','$modid')") ) {
        echo "Available Mods added successfully. <a href='index4.php'>View Weapon Mods Table</a>";
    }else{
        echo "An Error has occurred!";
     }
    unset($_POST['Submit']);
}
?>
</body>
</html>