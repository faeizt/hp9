<?
include '../DB.php';
$report				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['report_type']))); //incident | project | engineer
$graph				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['graph_type'])));  //daily | weekly | monthly | yearly
$date 				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['date_type'])));   //open | assign | onsite | pending | resolve | close
$begin	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['begin'])));       // begin date
$end	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['end'])));         // end date

$begin_date 		= strtotime($begin);
$end_date 			= strtotime($end);
$datediff			= $end_date - $begin_date;
$days 				= $datediff/(60*60*24);

if ($days < 32) {
	$open = "CREATE TEMPORARY TABLE daily AS SELECT dayNumberOfMonth FROM dates WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d'))";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']= $report;
		$result = "SELECT days,IFNULL(COUNT(open_date),0) FROM daily LEFT JOIN v_incident ON DAY(open_Date) = days AND open_Date BETWEEN (STR_TO_DATE('2014-01-01', '%Y-%m-%d')) AND (STR_TO_DATE('2014-02-01', '%Y-%m-%d')) GROUP BY days;";
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['Y'];
			$tmp[1] = $r['R'];
			$axis[0] = $tmp[0];
			$axis[1] 	= " ".$tmp[0];

			array_push($v, $tmp);
			array_push($x, $axis);	
			
		}
		$h['data']=$v;
		$h['xaxis']=$x;


		print_r( json_encode($h) );

	}
}


else echo "string2";
?>