<?php 
	include '../DB.php';


	if(isset($_GET['project'])){
		$project = $_GET['project'];
		$sql = "select id as sla from sla where project_code='$project'";
		$query	=	mysqli_query($con,$sql)  or die("sql= ". $sql);        //query
		$result		=	mysqli_fetch_array( $query );
		$sla   		=  $result['sla'];

		echo $sla;
	}

?>