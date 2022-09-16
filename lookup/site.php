<?php
	include '../DB.php';
	//$con = mysql_connect($host,$user,$pass);
	//$dbs = mysql_select_db($databaseName, $con);
    $q = strtolower($_GET["term"]);
	$project_code = strtolower($_GET["project_code"]);

	$return = array();
	if ($project_code=="") {
		$sql = "SELECT * FROM `vclientaddr` AS client_site WHERE site_name LIKE '%$q%' limit 10";
	}
	else{
		$sql = "SELECT * FROM `vclientaddr` AS client_site WHERE  project_code='$project_code' and site_name LIKE '%$q%' limit 10";

	}
	// echo $sql;
	$query = mysqli_query($con,$sql) or die('sql= '.$sql);
	while ($row = mysqli_fetch_array($query)) {
		array_push($return,array('client'=>$row['client_code'],'project'=>$row['project_code'],'label'=>$row['site_name'],'value'=>$row['site_name'],'desc'=>$row['site_id'],'addr_id'=>$row['addr_id'],'addr1'=>$row['addr1'],'addr2'=>$row['addr2'],'postcode'=>$row['postcode'],'city'=>$row['city'],'statename'=>$row['statename']));
	}
	echo(json_encode($return));
?>