<?php
if(isset($_POST['username'])){
	$username		= htmlspecialchars(trim($_POST['username']));
	$password	= htmlspecialchars(trim($_POST['password']));


	include 'DB.php';
    $sqlquery = "SELECT user_id,username,name,role_id,status,project,def_project_name,profile_image,DATE_FORMAT(last_login,'%d %b %Y %h:%i %p') last_login, ifnull(def_project,SUBSTRING_INDEX(project,',',1)) def_project, password,listCase,columnc FROM sys_users WHERE (username = '" .$username. "') and (password = '" . md5($password) . "')";
	$result	=	mysqli_query($con,$sqlquery)or die( mysqli_error($con));
	$row		=	mysqli_fetch_array( $result );
	$num		=	mysqli_num_rows($result);
	if ($num == 1 ) {
		session_start();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['profile_image'] = $row['profile_image'];
		$_SESSION['username'] = $username;
		$_SESSION['name'] = $row['name'];
		$_SESSION['usertype'] = $row['role_id'];
		$_SESSION['status'] = $row['status'];
		$_SESSION['project'] = $row['project'];
		$_SESSION['def_project'] = $row['def_project'];
		$_SESSION['def_project_name'] = $row['def_project_name'];      
		$_SESSION['last_login'] = $row['last_login'];
		$_SESSION['listCase'] = unserialize($row['listCase']);
		$_SESSION['columnc'] = unserialize($row['columnc']);
		$_SESSION['column'] = "";  
		$_SESSION['nav_level'] = "0";
		$_SESSION['nav_title'] = "dashboard";		
		// echo $sqlquery;
		echo"true";//return auth value
	}
	else{echo "false";}//return auth value
}
else{   echo "false";}//return auth value
?>