<?php
// include database connection file
include '../config.php';

session_start();

if(!(isset($_SESSION['status'])) && $_SESSION['status'] != TRUE){
    header("location:../index.php");
}

if(!(isset($_GET['deletedb'])) && !(isset($_GET['dataid']))){
	header("location:../index.php");
}

// Get id from URL to delete that user
$type = $_GET['deletedb'];
$id = $_GET['dataid'];

// Delete user row from table based on given id

switch ($type) {
    case "1":
        if($result = mysqli_query($conn, "DELETE FROM enemy_char WHERE id=$id")){
            $_SESSION['modify_char'] = 1;
        }else{
            $_SESSION['modify_char'] = 0;
        }
        header("location:index.php");
      break;
    case "2":
        if($result = mysqli_query($conn, "DELETE FROM weapon_table WHERE weapon_id=$id")){
            $_SESSION['modify_weap'] = 1;
        }else{
            $_SESSION['modify_weap'] = 0;
        }
        header("location:index5.php");
      break;
    case "3":
        if($result = mysqli_query($conn, "DELETE FROM weaponmods_table WHERE weaponmods_id=$id")){
            $_SESSION['modify_weapmod'] = 1;
        }else{
            $_SESSION['modify_weapmod'] = 0;
        }
        header("location:index4.php");
      break;
    case "4":
        if($result = mysqli_query($conn, "DELETE FROM weapon_weaponmods WHERE id=$id")){
            $_SESSION['modify_availmods'] = 1;
        }else{
            $_SESSION['modify_availmods'] = 0;
        }
        header("location:index4.php");
      break;
    default:
        echo "ERROR";
        header("location:../index.php");
    break;
} 
?>
