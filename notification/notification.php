<?php
 
class notification
{
	public $arrayName = array();
	public function __construct(){
	//	include '../DB.php';

	}
	public function getSubject($action, $object, $actor){
		switch ($action) {
			case 'create':
				//get creator & assigned person - from incident table
				$stmt 			= 	"select open_by,engineer,client_code from v_incident where case_id = '$object'";

				$host = "localhost";
				$user = "root";
				$pass = "";
				$databaseName = "thehelpdesk";
				
				  $con = mysqli_connect($host,$user,$pass);
				  $dbs = mysqli_select_db($con,$databaseName);

				$query 			= 	mysqli_query($con,$stmt) or die(mysqli_error($con));
				$row 			=	mysqli_fetch_array($query) or die(mysqli_error($con));

				$client_code 	= 	$row["client_code"];
				$Names 			=	array();


				$stmt_client 	= "SELECT ac.user_id,username,role FROM sys_user_ac ac left join sys_users u on u.user_id=ac.user_id  WHERE ac.access > 0 AND client_code = '$client_code' and role in (5,6,8)";
				$query_client	= 	mysqli_query($con,$stmt_client) or die(mysqli_error($con));
				while ($row_client  	=	mysqli_fetch_array($query_client)) {
					if ($row_client['role']=="5") {
						if ($row_client['username'] != $actor) {
							$Names['Administrator'] = $row_client['username'];
						}						
					}
					if ($row_client['role']=="6") {
						if ($row_client['username'] != $actor) {
							$Names['Manager'] = $row_client['username'];
						}	
					}					
					if ($row_client['role']=="8") {
						if ($row_client['username'] != $actor) {
							$Names['Client'] = $row_client['username'];
						}	
					}
				} 
				return $Names;
				break;
			case 'comment':
				$stmt 			= 	"select open_by,engineer_name,client_code from v_incident where case_id = '$object'";
				$query 			= 	mysqli_query($con,$stmt) or die(mysqli_error($con));
				$row 			=	mysqli_fetch_array($query) or die(mysqli_error($con));

				$client_code 	= 	$row["client_code"];
				$Names 			=	array();
				$Names['Assignee']= $row["engineer_name"];

				$stmt_client 	= "SELECT ac.user_id,username,role FROM sys_user_ac ac left join sys_users u on u.user_id=ac.user_id  WHERE ac.access > 0 AND client_code = '$client_code' and role in (5,6,8)";
				$query_client	= 	mysqli_query($con,$stmt_client) or die(mysqli_error($con));
				while ($row_client  	=	mysqli_fetch_array($query_client)) {
					if ($row_client['role']=="5") {
						$Names['Administrator'] = $row_client['username'];
					}
					if ($row_client['role']=="6") {
						$Names['Manager'] = $row_client['username'];
					}					
					if ($row_client['role']=="8") {
						$Names['Client'] = $row_client['username'];
					}
				} 
				return $Names;
				break;
			case 'assign':
				//get creator & assigned person - from incident table
				$stmt 			= 	"select open_by,engineer_name,client_code from v_incident where case_id = '$object'";
				$query 			= 	mysqli_query($con,$stmt) or die(mysqli_error($con));
				$row 			=	mysqli_fetch_array($query) or die(mysqli_error($con));

				$client_code 	= 	$row["client_code"];
				$Names 			=	array();
				if ($row["open_by"] != $actor) {
					$Names['Creator'] = $row["open_by"];
				}	
				$Names['Assignee']= $row["engineer_name"];

				// get pm,client contact - {incident_id} roleid - 3
				$stmt_client = "SELECT ac.user_id,username,role FROM sys_user_ac ac left join sys_users u on u.user_id=ac.user_id  WHERE ac.access > 0 AND client_code = '$client_code' and role in (5,6,8)";
				// echo $stmt_client;
				$query_client	= 	mysqli_query($con,$stmt_client) or die(mysqli_error($con));
				while ($row_client  	=	mysqli_fetch_array($query_client)) {
					if ($row_client['role']=="5") {
						if ($row_client['username'] != $actor) {
							$Names['Administrator'] = $row_client['username'];
						}	

					}
					if ($row_client['role']=="6") {
						if ($row_client['username'] != $actor) {
							$Names['Manager'] = $row_client['username'];
						}	
					}					
					if ($row_client['role']=="8") {
						if ($row_client['username'] != $actor) {
							$Names['Client'] = $row_client['username'];
						}	
					}
				} 

				//get pm - sys_user_ac role {5,6} access <>0
				// $array = array("foo", "bar", "hello", "world");
				return $Names;
				break;
			case 'update':
				$stmt 			= 	"select open_by,engineer,client_code from v_incident where case_id = '$object'";
				$query 			= 	mysqli_query($con,$stmt) or die(mysqli_error($con));
				$row 			=	mysqli_fetch_array($query) or die(mysqli_error($con));

				$client_code 	= 	$row["client_code"];
				$Names 			=	array();
				$Names['Assignee']= $row["engineer"];

				$stmt_client 	= "SELECT ac.user_id,username,role FROM sys_user_ac ac left join sys_users u on u.user_id=ac.user_id  WHERE ac.access > 0 AND client_code = '$client_code' and role in (5,6,8)";
				$query_client	= 	mysqli_query($con,$stmt_client) or die(mysqli_error($con));
				while ($row_client  	=	mysqli_fetch_array($query_client)) {
					if ($row_client['role']=="5") {
						$Names['Administrator'] = $row_client['username'];
					}
					if ($row_client['role']=="6") {
						$Names['Manager'] = $row_client['username'];
					}					
					if ($row_client['role']=="8") {
						$Names['Client'] = $row_client['username'];
					}
				} 
				return $Names;
				break;
			case 'pending':
				$stmt 			= 	"select open_by,engineer,client_code from v_incident where case_id = '$object'";
				$query 			= 	mysqli_query($con,$stmt) or die(mysqli_error($con));
				$row 			=	mysqli_fetch_array($query) or die(mysqli_error($con));

				$client_code 	= 	$row["client_code"];
				$Names 			=	array();
				$Names['Assignee']= $row["engineer"];

				$stmt_client 	= "SELECT ac.user_id,username,role FROM sys_user_ac ac left join sys_users u on u.user_id=ac.user_id  WHERE ac.access > 0 AND client_code = '$client_code' and role in (5,6,8)";
				$query_client	= 	mysqli_query($con,$stmt_client) or die(mysqli_error($con));
				while ($row_client  	=	mysqli_fetch_array($query_client)) {
					if ($row_client['role']=="5") {
						$Names['Administrator'] = $row_client['username'];
					}
					if ($row_client['role']=="6") {
						$Names['Manager'] = $row_client['username'];
					}					
					if ($row_client['role']=="8") {
						$Names['Client'] = $row_client['username'];
					}
				} 
				return $Names;
				break;
			case 'recurrence':
				$stmt 			= 	"select open_by,engineer,client_code from v_incident where case_id = '$object'";
				$query 			= 	mysqli_query($con,$stmt) or die(mysqli_error($con));
				$row 			=	mysqli_fetch_array($query) or die(mysqli_error($con));

				$client_code 	= 	$row["client_code"];
				$Names 			=	array();
				$Names['Assignee']= $row["engineer"];

				$stmt_client 	= "SELECT ac.user_id,username,role FROM sys_user_ac ac left join sys_users u on u.user_id=ac.user_id  WHERE ac.access > 0 AND client_code = '$client_code' and role in (5,6,8)";
				$query_client	= 	mysqli_query($con,$stmt_client) or die(mysqli_error($con));
				while ($row_client  	=	mysqli_fetch_array($query_client)) {
					if ($row_client['role']=="5") {
						$Names['Administrator'] = $row_client['username'];
					}
					if ($row_client['role']=="6") {
						$Names['Manager'] = $row_client['username'];
					}					
					if ($row_client['role']=="8") {
						$Names['Client'] = $row_client['username'];
					}
				} 
				return $Names;
				break;								
			default:
				$stmt 			= 	"select open_by,engineer,client_code from v_incident where case_id = '$object'";
				$query 			= 	mysqli_query($con,$stmt) or die(mysqli_error($con));
				$row 			=	mysqli_fetch_array($query) or die(mysqli_error($con));

				$client_code 	= 	$row["client_code"];
				$Names 			=	array();
				$Names['Assignee']= $row["engineer"];

				$stmt_client 	= "SELECT ac.user_id,username,role FROM sys_user_ac ac left join sys_users u on u.user_id=ac.user_id  WHERE ac.access > 0 AND client_code = '$client_code' and role in (5,6,8)";
				$query_client	= 	mysqli_query($con,$stmt_client) or die(mysqli_error($con));
				while ($row_client  	=	mysqli_fetch_array($query_client)) {
					if ($row_client['role']=="5") {
						$Names['Administrator'] = $row_client['username'];
					}
					if ($row_client['role']=="6") {
						$Names['Manager'] = $row_client['username'];
					}					
					if ($row_client['role']=="8") {
						$Names['Client'] = $row_client['username'];
					}
				} 
				return $Names;
				break;
		}
	}
	public function sendNotification($arr,$case_id){
		foreach ($arr as $value) {
			if ($value != "") {
			$stmt = "insert into notification (user, case_id, msg, date, seen) values ('$value','$case_id','got msg for you',now(),'N')";
			mysqli_query($con,$stmt)or die(mysqli_error($con));
			}
		}

	}
	public function updateNotification($id){
			$stmt = "update notification set seen='Y' where id = '$id' ";
			mysqli_query($con,$stmt)or die(mysqli_error($con));

	}	
}
 
?>