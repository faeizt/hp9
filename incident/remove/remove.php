<?
	include '../../DB.php';
	$case_id  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['case_id'])));
	
	$com_ref_no_update	= 	"delete from cases where case_id = '$case_id'";

		if(mysqli_query($con,$com_ref_no_update)){
			echo"true";
		}else{echo "app=".$com_ref_no_update;}   

?>