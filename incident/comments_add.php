<?
session_start();
if(isset($_POST['case_id'])){
	include '../DB.php';
	$case_id  	= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['case_id'])));
	$comments	= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['comments'])));
	$user_id	= $_SESSION['user_id'];

	$addApplication			= 	"INSERT INTO comments (case_id, user_id,comments,date) VALUES ('$case_id','$user_id','$comments',now())";

	if(mysqli_query($con,$addApplication)){
		echo "true";
	}else{echo "app=".$addApplication;}        								
}
else{   echo "false";}//return auth value
?>