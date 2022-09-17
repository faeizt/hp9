<?php
if(isset($_POST['user_id'])){
	include '../../DB.php';
	$user_id  				= 	mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['user_id'])));
	$rm_user	= 	"DELETE FROM sys_users WHERE user_id = '$user_id'";
	if(mysqli_query($con,$rm_user)){
		echo"true";
	}else{echo "app=".$rm_user;}    						
}
else{   echo "false";}//return auth value
?>