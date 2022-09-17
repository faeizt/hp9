<?php
if(isset($_POST['pk'])){
	include '../DB.php';
	$app_no  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['pk'])));
	$column	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['name'])));
	$value	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['value'])));
	
	$com_ref_no_update	= 	"UPDATE applications SET $column = '$value'  WHERE app_no ='$app_no'";

		if(mysqli_query($con,$com_ref_no_update)){
			echo"true";
		}else{echo "app=".$com_ref_no_update;}   

		$share_update = "UPDATE applications SET numberofshares = (CAPITAL/PRICEPERUNIT)	 WHERE app_no = '$app_no' ".
						"AND capital IS NOT NULL AND capital <>'' ".
						"AND priceperunit IS NOT NULL AND priceperunit <>''";
		mysqli_query($con,$share_update); 						
}
else{   echo "false";}//return auth value
?>