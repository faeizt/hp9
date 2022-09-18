<?php
session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../index.html' ) ;
}
if(isset($_POST['case_id'])){
	include '../../DB.php';
	$case_id  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['case_id'])));
	$site    			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['site'])));
	$address			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['address'])));
	$report_channel		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['report_channel'])));
	$contact_person		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['contact_person'])));
	$contact_no			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['contact_no'])));
	$add_info			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['add_info'])));
	$title 				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['title'])));
	$description		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['description'])));
	$sn					= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['sn'])));
	$asset				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['asset'])));
	$service_type		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['service_type'])));
	$category			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['category'])));
	$sla	 			= 0;
	$severity 			= 0;
	$recurrence 		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['recurrence'])));

	if ($asset=="") $asset=0;

   $addCase  = "update cases set ".
   	"site_id = '".$site."', ".
   	"addr_id ='".$address."',  ".
   	"caller = '".$contact_person."', ".
   	"contact = '".$contact_no."', ".
   	"info = '".$add_info."', ".
   	"via = '".$report_channel."', ". 
   	"servType = '".$service_type."', ".
   	"cat = '".$category."', ".
   	"product = UCASE('".$asset."'), ".
   	"sn = UCASE('".$sn."'), ".
   	"title = '".$title."', ".
   	"problem = '".$description."', ".
   	"flag = '".$severity."', ".
   	"recurrence = '".$recurrence."' ".
   	"where case_id = '$case_id'";
    mysqli_query($con,$addCase) or die($addCase .mysqli_error($con));
    echo"SAVED";
}
?>