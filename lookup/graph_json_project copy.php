<?php
include '../DB.php';
$report				= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['report_type']))); //incident | project | engineer
$project			= (htmlspecialchars(trim($_GET['project'])));  //daily | weekly | monthly | yearly
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



$h['data']=$v;
$h['xaxis']=$x;
$h['xlabel']="Yearly Incidents from ".$begin." - " . $end;


  
  // data strored in array
  $h = Array (
	  "0" => Array (
		  "jumlah" => "100",
		  "bulan" => "Olivia Mason"	  
		),
	  "1" => Array (
		  "jumlah" => "233",
		  "bulan" => "Senior Programmer"
	  ),
	  "2" => Array (
		  "jumlah" => "566",
		  "bulan" => "Office Manager"
	  )
  );
  
  // encode array to json

  print_r( json_encode($h) );

  ?>