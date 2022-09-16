<?
if(isset($_POST['category_id'])){
	include '../../DB.php';
	$category_id  				= 	mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['category_id'])));
	$delComActivities	= 	"DELETE FROM code_definition WHERE code_definition_id = '$category_id'";
	if(mysqli_query($con,$delComActivities)){
		echo"true";
	}else{echo "app=".$delComActivities;}    						
}
else{   echo "false";}//return auth value
?>