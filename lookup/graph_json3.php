<?
   include '../DB.php';
$h = array();
$v = array();
$a = array();
$someWords = "LHDN02,MARA01";
$wordChunks = explode(",", $someWords);
for($j = 0; $j < count($wordChunks); $j++){
	// echo $wordChunks[$j];
$h['label']= $wordChunks[$j];
	$result = "SELECT MONTH(open_Date) Y,COUNT(*) R FROM  helpdesk.cases where project_code = '$wordChunks[$j]' GROUP BY MONTH(open_date) order by MONTH(open_date) asc;";
	$q = mysqli_query($con,$result);
	while($r = mysqli_fetch_array($q)) {
		$tmp[0] = $r['Y'];
		$tmp[1] = $r['R'];
		array_push($v, $tmp);
		
	}
	$h['data']=$v;	
	array_push($a, $h);
	$v = array();
	?><?
}



/**
 *   Expected Array Result:
**/
print_r( json_encode($a) );

?>