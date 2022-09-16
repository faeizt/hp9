<?php
	include '../DB.php';
	$con = mysql_connect($host,$user,$pass);
	$dbs = mysql_select_db($databaseName, $con);
    $q = strtolower($_GET["term"]);
    $project_code = strtolower($_GET["project_code"]);
    $site_id = strtolower($_GET["site_id"]);


	$return = array();
	if($project_code=="")$sqlquery ="SELECT cases.*,COUNT(*) count_ord FROM (SELECT CONCAT(caller,' (',cases.client_code,' ',cases.site_name,')') callerlabel,caller,contact,cases.site_name,cases.addr_id,addr1,addr2,postcode, city, statename,client_site.site_id ,open_date,cases.project_code,cases.client_code FROM `casesaddr` cases LEFT JOIN client_site ON cases.site_id = client_site.site_id WHERE  caller LIKE '%$q%' ORDER BY open_date DESC ) cases GROUP BY CONCAT(cases.site_id) ORDER BY count_ord DESC LIMIT 7;";
	else if($site_id=="")$sqlquery ="SELECT cases.*,COUNT(*) count_ord FROM (SELECT CONCAT(caller,' (',cases.client_code,' ',cases.site_name,')') callerlabel,caller,contact,cases.site_name,cases.addr_id,addr1,addr2,postcode, city, statename,client_site.site_id ,open_date,cases.project_code,cases.client_code FROM `casesaddr` cases LEFT JOIN client_site ON cases.site_id = client_site.site_id WHERE cases.project_code = '$project_code' and caller LIKE '%$q%' ORDER BY open_date DESC ) cases GROUP BY CONCAT(cases.site_id) ORDER BY count_ord DESC LIMIT 7;";
	else $sqlquery 				=	"SELECT cases.*,COUNT(*) count_ord FROM (SELECT CONCAT(caller,' (',cases.client_code,' ',cases.site_name,')') callerlabel,caller,contact,cases.site_name,cases.addr_id,addr1,addr2,postcode, city, statename,client_site.site_id ,open_date,cases.project_code,cases.client_code FROM `casesaddr` cases LEFT JOIN client_site ON cases.site_id = client_site.site_id WHERE cases.project_code = '$project_code' and cases.site_id = '$site_id' and caller LIKE '%$q%' ORDER BY open_date DESC ) cases GROUP BY CONCAT(cases.site_id) ORDER BY count_ord DESC LIMIT 7;";

	$query = mysqli_query($con,$sqlquery);
	// echo$sqlquery;
	while ($row = mysqli_fetch_array($query)) {
		array_push($return,array('label'=>$row['callerlabel'],'value'=>$row['caller'],'desc'=>$row['contact'],'site_id'=>$row['site_id'],'site'=>$row['site_name'],'addr_id'=>$row['addr_id'],'addr1'=>$row['addr1'],'addr2'=>$row['addr2'],'postcode'=>$row['postcode'],'city'=>$row['city'],'statename'=>$row['statename'],'client'=>$row['client_code'],'project'=>$row['project_code']));
	}
	echo(json_encode($return));
?>