<?php session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../index.html' ) ;
}
if(isset($_POST['client'])){
	include '../../DB.php';
	$client  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['client'])));
	$project  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project'])));
	$type   			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['type'])));
	$brand				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['brand'])));
	$model				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['model'])));
	$spec				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['spec'])));


   $addCase  = "INSERT INTO product (client_code,project_code, product_type,brand,model,spec) ". 
                 "VALUES('$client','".$project."','".$type."','".$brand."','".$model."','".$spec."' ".
                 ")";
	if (isset($_POST['id'])) {
		$id = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['id'])));
		$addCase = "update product set client_code = '$client',project_code='$project',product_type='$type',brand='$brand',model='$model',spec='$spec' where product_id = '$id'";
	}
    mysqli_query($con,$addCase) or die($addCase .mysqli_error($con));
    echo"SAVED";
}
?>