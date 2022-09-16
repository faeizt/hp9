<?
if(isset($_POST['app_no'])){
	include '../DB.php';
	$app_no  	= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['app_no'])));
	$id  		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['id'])));


	if(($app_no!="") && ($id!="")){

		$delComActivities			= 	"DELETE FROM address WHERE id = '$id'";
	}
		if(mysqli_query($con,$delComActivities)){
			echo"true";
		}else{echo "app=".$delComActivities;}    						
}
else{   echo "false";}//return auth value
?>