<?
include '../DB.php';
$report				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['report_type']))); //incident | project | engineer
$engineer			= (htmlspecialchars(trim($_GET['engineer'])));  //daily | weekly | monthly | yearly
$date 				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['date_type'])));   //open | assign | onsite | pending | resolve | close
$begin	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['begin'])));       // begin date
$end	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['end'])));         // end date
$sql	    		= (htmlspecialchars(trim($_GET['sql'])));         // end date

if ($sql !="") {
	$sql 				= " AND ".$sql;
}else{$sql 				= "";}


$begin_date 		= strtotime($begin);
$end_date 			= strtotime($end);
$datediff			= $end_date - $begin_date;
$days 				= $datediff/(60*60*24);

$engineer_name = "select name from sys_users where user_id = '$engineer'";
$q_engineer_name = mysqli_query($con,$engineer_name);
$r_engineer_name = mysqli_fetch_array($q_engineer_name);
$engineer_name = $r_engineer_name['name'];

if ($days < 32) { //daily report
	$open = "CREATE TEMPORARY TABLE daily AS SELECT  @n := @n + 1 n,dayNumberOfMonth days FROM dates,(SELECT @n := 0) m WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d'))";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']= $engineer_name;
		$result = "SELECT n,days Y,IFNULL(COUNT($date),0) R FROM daily LEFT JOIN v_incident ON engineer='$engineer' ".$sql." and  DAY($date) = days AND $date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND DATE_ADD((STR_TO_DATE('$end', '%Y-%m-%d')), INTERVAL 1 DAY) GROUP BY days order by n";
		// echo $result;
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['n'];
			$tmp[1] = $r['R'];
			$axis[0] = $r['n'];
			$axis[1] 	= $r['Y'];

			array_push($v, $tmp);
			array_push($x, $axis);	
			
		}
		$h['data']=$v;
		$h['xaxis']=$x;
		$h['xlabel']="Daily Incidents from ".$begin." - " . $end;


		print_r( json_encode($h) );

	}
}
else if ($days > 31 && $days< 64) { //weekly report
	$open = "CREATE TEMPORARY TABLE weekno AS SELECT @n := @n + 1 n,calendarweekno weekno FROM dates,(SELECT @n := 0) m WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d'))GROUP BY calendarweekno ORDER BY date_key";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']= $engineer_name;
		$result = "SELECT n,weekno Y,IFNULL(COUNT($date),0) R FROM weekno LEFT JOIN v_incident ON WEEK($date) = weekno and engineer='$engineer' ".$sql."  AND $date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY weekno order by n";
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['n'];
			$tmp[1] = $r['R'];
			$axis[0] = $r['n'];
			$axis[1] 	= $r['Y'];

			array_push($v, $tmp);
			array_push($x, $axis);	
			
		}
		$h['data']=$v;
		$h['xaxis']=$x;
		$h['xlabel']="Daily Incidents from ".$begin." - " . $end;

		print_r( json_encode($h) );


	}
}
else if ($days > 64 && $days< 366) { //weekly report
	$open = "CREATE TEMPORARY TABLE monthly AS SELECT  @n := @n + 1 n,`calendarMonthNo` MONTH  FROM dates,(SELECT @n := 0) m WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY MONTH";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']= $engineer_name;
		$result = "SELECT  n, month,MONTHNAME(STR_TO_DATE(month, '%m')) Y,IFNULL(COUNT($date),0) R FROM monthly LEFT JOIN v_incident ON MONTH($date) = MONTH and engineer='$engineer' ".$sql."  AND $date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY MONTH order by n";
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['n'];
			$tmp[1] = $r['R'];
			$axis[0] = $r['n'];
			$axis[1] 	= $r['Y'];

			array_push($v, $tmp);
			array_push($x, $axis);	
			
		}
		$h['data']=$v;
		$h['xaxis']=$x;
		$h['xlabel']="Daily Incidents from ".$begin." - " . $end;


		print_r( json_encode($h) );


	}
}
else if ($days > 366) { //weekly report
	$open = "CREATE TEMPORARY TABLE yearly AS SELECT @n := @n + 1 n,`calendarYear` YEAR FROM dates,(SELECT @n := 0) m  WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY YEAR";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']= $engineer_name;
		$result = "SELECT n,YEAR Y,IFNULL(COUNT($date),0) R FROM yearly LEFT JOIN v_incident ON YEAR($date) = YEAR and engineer='$engineer' ".$sql."  AND $date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY YEAR";
		// echo $result;
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['n'];
			$tmp[1] = $r['R'];
			$axis[0] = $r['n'];
			$axis[1] 	= $r['Y'];

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