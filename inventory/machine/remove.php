<?php
if(isset($_POST['id'])){
	include '../../DB.php';
	$id  				= 	mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['id'])));
	$delComActivities	= 	"DELETE FROM product WHERE product_id = '$id'";
	if(mysqli_query($con,$delComActivities)){
		echo"true";
	}else{echo "app=".$delComActivities;}    						
}
else{   echo "false";}//return auth value
?>