<?php
include '../DB.php';
$q 		= strtolower($_GET["term"]);
$return = array();
$stmt	= "select * from v_inventory where sn like '%$q%' limit 10";
$query 	= mysqli_query($con,$stmt);
while ($row = mysqli_fetch_array($query)) {
	array_push($return,array('label'=>$row['sn'],'value'=>$row['sn'],'machine'=>$row['product_id'],'client'=>$row['client_code'],'project'=>$row['project_code']));
}
echo(json_encode($return));
?>