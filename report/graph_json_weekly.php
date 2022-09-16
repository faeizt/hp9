<?
include '../DB.php';
$report				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['report_type']))); //incident | project | engineer
$graph				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['graph_type'])));  //daily | weekly | monthly | yearly
$date 				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['date_type'])));   //open | assign | onsite | pending | resolve | close
$begin	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['begin'])));       // begin date
$end	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['end'])));         // end date

$open = "CREATE TEMPORARY TABLE weekno AS SELECT calendarweekno weekno FROM dates WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d'))GROUP BY calendarweekno";
if(mysqli_query($con,$open)) {
	$h = array();
	$v = array();
	$x = array();
	$h['label']='Incident';
	$result = "SELECT weekno Y,IFNULL(COUNT(open_date),0) R FROM weekno LEFT JOIN v_incident ON WEEK(open_Date) = weekno AND open_Date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY weekno";
	$q = mysqli_query($con,$result);
	$i=0;
	while($r = mysqli_fetch_array($q)) {
		$i++;
		$tmp[0] = $r['Y'];
		$tmp[1] = $r['R'];
		$axis[0] = $tmp[0];
		$axis[1] 	= "Week ".$tmp[0];

		array_push($v, $tmp);
		array_push($x, $axis);	
		
	}
	$h['data']=$v;
	$h['xaxis']=$x;


	print_r( json_encode($h) );

}
else echo "string2";
?>