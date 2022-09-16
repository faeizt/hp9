<?
include '../DB.php';
$report				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['report_type']))); //incident | project | engineer
$project				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['project'])));  //daily | weekly | monthly | yearly
$date 				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['date_type'])));   //open | assign | onsite | pending | resolve | close
$begin	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['begin'])));       // begin date
$end	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['end'])));         // end date

$begin_date 		= strtotime($begin);
$end_date 			= strtotime($end);
$datediff			= $end_date - $begin_date;
$days 				= $datediff/(60*60*24);

if ($days < 32) { //daily report
	$open = "CREATE TEMPORARY TABLE daily AS SELECT  @n := @n + 1 n,dayNumberOfMonth days FROM dates,(SELECT @n := 0) m WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d'))";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']= $project;
		$result = "SELECT n,days Y,IFNULL(COUNT(open_date),0) R FROM daily LEFT JOIN v_incident ON project_code='$project' and  DAY(open_Date) = days AND open_Date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY days order by n";
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['Y'];
			$tmp[1] = $r['R'];
			$axis[0] = $r['n'];
			$axis[1] 	= " ".$tmp[0];

			array_push($v, $tmp);
			array_push($x, $axis);	
			
		}
		$h['data']=$v;
		$h['xaxis']=$x;


		print_r( json_encode($h) );

	}
}
else if ($days > 31 && $days< 64) { //weekly report
	$open = "CREATE TEMPORARY TABLE weekno AS SELECT @n := @n + 1 n,calendarweekno weekno FROM dates,(SELECT @n := 0) m WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d'))GROUP BY calendarweekno ORDER BY date_key";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']='Incident';
		$result = "SELECT n,weekno Y,IFNULL(COUNT(open_date),0) R FROM weekno LEFT JOIN v_incident ON WEEK(open_Date) = weekno AND open_Date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY weekno order by n";
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
else if ($days > 64 && $days< 366) { //weekly report
	$open = "CREATE TEMPORARY TABLE monthly AS SELECT `calendarMonthNo` MONTH  FROM dates WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY MONTH";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']='Incident';
		$result = "SELECT  month,MONTHNAME(STR_TO_DATE(month, '%m')) Y,IFNULL(COUNT(open_date),0) R FROM monthly LEFT JOIN v_incident ON MONTH(open_Date) = MONTH AND open_Date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY MONTH";
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['month'];
			$tmp[1] = $r['R'];

			$axis[0] = $tmp[0];
			$axis[1] 	= $r['Y'];

			array_push($v, $tmp);
			array_push($x, $axis);	
			
		}
		$h['data']=$v;
		$h['xaxis']=$x;


		print_r( json_encode($h) );


	}
}
else if ($days > 366) { //weekly report
	$open = "CREATE TEMPORARY TABLE yearly AS SELECT `calendarYear` YEAR FROM dates WHERE date_key BETWEEN (STR_TO_DATE('2013-01-01', '%Y-%m-%d')) AND (STR_TO_DATE('2014-12-31', '%Y-%m-%d')) GROUP BY YEAR";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']='Incident';
		$result = "SELECT YEAR Y,IFNULL(COUNT(open_date),0) R FROM yearly LEFT JOIN v_incident ON YEAR(open_Date) = YEAR AND open_Date BETWEEN (STR_TO_DATE('2013-01-01', '%Y-%m-%d')) AND (STR_TO_DATE('2014-12-01', '%Y-%m-%d')) GROUP BY YEAR";
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['Y'];
			$tmp[1] = $r['R'];

			$axis[0] = $tmp[0];
			$axis[1] = $tmp[0] ;

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