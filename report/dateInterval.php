<?
 $now = time(); // or your date as well
	$begin_date = strtotime("2014-01-01");
	$end_date = strtotime("2014-01-31");
	$datediff = $end_date - $begin_date;
	echo floor($datediff/(60*60*24));
?>