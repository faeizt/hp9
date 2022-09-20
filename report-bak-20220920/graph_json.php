<?php
session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: index.html' ) ;
}

include '../DB.php';

$access_query     =   "SELECT * FROM sys_user_ac WHERE user_id = ".$_SESSION['user_id'] ;      // echo $sqlquery;
$result           =   mysqli_query($con,$access_query) or die("sql= ". $access_query);          //query
$result_array = array();

while($row = mysqli_fetch_array($result)){
$result_array[] = $row;
}

$project="";
$PAC  = 0;

foreach ($result_array as $results) {
  $PAC = $results['access'];
  if ($PAC & 8192) {
    $project = $project. "'" .$results['project_code'] . "',";
  }
}
$project = substr($project,0,-1);
$project_list = "project_code in (".$project.") ";


$report				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['report_type']))); //incident | project | engineer
$project			= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['project'])));  //Project
$status				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['status'])));  //status
$engineer			= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['engineer'])));  //engineer
$date 				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['date_type'])));   //open | assign | onsite | pending | resolve | close
$begin	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['begin'])));       // begin date
$end	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['end'])));         // end date
$sql	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['sql'])));         // end date
    $sql    = str_replace("\\", "", $sql);
if ($sql !="") {
	$sql 				= " AND ".$sql;
}else{$sql 				= "";}

$begin_date 		= strtotime($begin);
$end_date 			= strtotime($end);
$datediff			= $end_date - $begin_date;
$days 				= $datediff/(60*60*24);
//echo $days;

if ($days < 32) { //daily report
	$open = "CREATE TEMPORARY TABLE daily AS SELECT @n := @n + 1 n,dayNumberOfMonth days FROM dates,(SELECT @n := 0) m  WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND  DATE_ADD((STR_TO_DATE('$end', '%Y-%m-%d')), INTERVAL 0 DAY)";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']= $report;
//		$result = "SELECT n,days Y,IFNULL(COUNT($date),0) R FROM daily LEFT JOIN v_incident ON ".$project_list." and DAY($date) = days ".$sql." AND $date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND DATE_ADD((STR_TO_DATE('$end', '%Y-%m-%d')), INTERVAL 1 DAY) GROUP BY days  order by n";
        $result = "
		SELECT week(open_date) as n, count(*) as R FROM thehelpdesk.v_incident
		where  open_date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d'))
		and $project_list
		group by n
		order by n asc;
		";
// echo $result;
		$q = mysql_query($result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['n'];
			$tmp[1] = $r['R'];
			$axis[0] = $r['n'];
			$axis[1] 	= $r['n'];

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
		$h['label']='Incident';
		$result = "SELECT n,weekno Y,IFNULL(COUNT($date),0) R FROM weekno LEFT JOIN v_incident ON ".$project_list." and WEEK($date) = weekno  ".$sql." AND $date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND DATE_ADD((STR_TO_DATE('$end', '%Y-%m-%d')), INTERVAL 1 DAY) GROUP BY weekno order by n";
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
		$h['xlabel']="weekly Incidents from ".$begin." - " . $end;


		print_r( json_encode($h) );


	}
}
else if ($days > 64 && $days< 366) { //weekly report
	$open = "CREATE TEMPORARY TABLE monthly AS SELECT  @n := @n + 1 n,`calendarMonthNo` MONTH  FROM dates,(SELECT @n := 0) m WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY MONTH";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']='Incident';
		$result = "
		select all_months.month_num mm,
		CASE
			WHEN month_num = 1 THEN 'Jan'
			WHEN month_num = 2 THEN 'Feb'
			WHEN month_num = 3 THEN 'Mar'
			WHEN month_num = 4 THEN 'Apr'
			WHEN month_num = 5 THEN 'May'
			WHEN month_num = 6 THEN 'Jun'
			WHEN month_num = 7 THEN 'Jul'
			WHEN month_num = 8 THEN 'Aug'
			WHEN month_num = 9 THEN 'Sep'
			WHEN month_num = 10 THEN 'Oct'
			WHEN month_num = 11 THEN 'Nov'
			WHEN month_num = 12 THEN 'Dec'
		END as MON,
		ifnull(R,0) as R
		from
		(SELECT count(*) R,month(open_date) mm,
		project_code
		FROM  v_incident 
		where  open_date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) 
		and $project_list
		group by mm
		) as tmp
		RIGHT JOIN all_months on all_months.month_num=tmp.mm
		ORDER BY all_months.month_num ASC";
		//echo $result;
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['mm'];
			$tmp[1] = $r['R'];
			$axis[0] = $r['mm'];
			$axis[1] 	= $r['MON'];

			array_push($v, $tmp);
			array_push($x, $axis);	
		}
		$h['data']=$v;
		$h['xaxis']=$x;
		$h['xlabel']="Monthly Incidents from ".$begin." - " . $end;

		print_r( json_encode($h) );


	}
}
else if ($days > 366) { //weekly report
	$open = "CREATE TEMPORARY TABLE yearly AS SELECT  @n := @n + 1 n,`calendarYear` YEAR FROM dates,(SELECT @n := 0) m WHERE date_key BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND (STR_TO_DATE('$end', '%Y-%m-%d')) GROUP BY YEAR";
	if(mysqli_query($con,$open)) {
		$h = array();
		$v = array();
		$x = array();
		$h['label']='Incident';
		$result = "SELECT n,YEAR Y,IFNULL(COUNT($date),0) R FROM yearly LEFT JOIN v_incident ON ".$project_list." and YEAR($date) = YEAR  ".$sql." AND $date BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND DATE_ADD((STR_TO_DATE('$end', '%Y-%m-%d')), INTERVAL 1 DAY) GROUP BY YEAR order by n";
		// echo $result;
		$q = mysqli_query($con,$result);
		$i=0;
		while($r = mysqli_fetch_array($q)) {
			$i++;
			$tmp[0] = $r['n'];
			$tmp[1] = $r['R'];

			$axis[0] = $tmp[0];
			$axis[1] 	= $r['Y'];

			array_push($v, $tmp);
			array_push($x, $axis);	
			
		}
		$h['data']=$v;
		$h['xaxis']=$x;
		$h['xlabel']="Yearly Incidents from ".$begin." - " . $end;


		print_r( json_encode($h) );


	}
}
else echo "string2";
?>