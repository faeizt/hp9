<?php
if(isset($_POST['site_id']) && isset($_POST['addr_id'])){
	include '../../DB.php';
	$site_id  				= 	mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['site_id'])));
	$addr_id  				= 	mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['addr_id'])));
	$rm_site	= 	"DELETE FROM client_site WHERE site_id = '$site_id'";
	$rm_addr	= 	"DELETE FROM address WHERE addr_id = '$addr_id'";
	if(mysqli_query($con,$rm_site) && mysqli_query($con,$rm_addr)){
		echo"true";
	}else{echo "app=".$rm_site . "\n" . $rm_addr;}    						
}
else{   echo "false";}//return auth value
?>