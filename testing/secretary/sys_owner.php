<?
if(isset($_POST['pk'])){
	include '../DB.php';
	$id  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['pk'])));
	$column	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['name'])));
	$value	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['value'])));
	
	$com_ref_no_update	= 	"UPDATE sys_owner SET $column = '$value'  WHERE id ='$id'";

		if(mysqli_query($con,$com_ref_no_update)){
			echo"true";
		}else{echo "app=".$com_ref_no_update;}    						
}
else{   echo "false";}//return auth value
?>