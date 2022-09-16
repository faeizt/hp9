<?php 
include '../../../DB.php';
$user_id		=   htmlspecialchars(trim($_POST['user_id'])); 
$project_code	=   htmlspecialchars(trim($_POST['project_code'])); 
$result 		=  	mysqli_query($con,"SELECT ac.*,p.project_name,p.client_code FROM sys_user_ac ac,project p WHERE ac.project_code = p.project_code AND ac.user_id= '$user_id' AND ac.project_code = '$project_code'");          //query
$row 			=   mysqli_fetch_array($result);

$h 				= 	array();
$h['id']		=	$row["id"];
$h['role']		=	$row["role"];
$h['access']	=	$row["access"];

print_r( json_encode($h) );

?>