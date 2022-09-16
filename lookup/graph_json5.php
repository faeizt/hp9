<?
   $project    = htmlspecialchars(trim($_GET['project']));
   include '../DB.php';
$h = array();
$v = array();
$h['label']=$project;
$result = "SELECT MONTH(open_Date) Y,COUNT(*) R FROM helpdesk.cases where project_code = '$project' GROUP BY MONTH(open_date);";
$q = mysqli_query($con,$result);
$i=0;
while($r = mysqli_fetch_array($q)) {
		$i++;
	$tmp[0] = $r['Y'];
	$tmp[1] = $r['R'];
	array_push($v, $tmp);
	
}
$h['data']=$v;

/**
 *   Expected Array Result:
**/
print_r( json_encode($h) );

?>