<?php session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../index.html' ) ;
}
if(isset($_POST['code'])){
	include '../../DB.php';
	$code  				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['code'])));
	$acronym  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['acronym'])));
	$name    			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['name'])));

  // $code         = str_replace('\\', '', $code);

    $addCase  = "INSERT INTO client (client_code,NAME,acronym) VALUES ('$code','".$name."','".$acronym."')";
    if (isset($_POST['id'])) {
    	$id = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['id'])));
    	$addCase  = "UPDATE client SET client_code = '$code', name='".$name."',acronym='".$acronym."' where id = '$id'";
        mysqli_query($con,$addCase) or die($addCase .mysqli_error($con));
    }else{
       if(mysqli_query($con,$addCase)){
        $stmt_seq = "INSERT INTO seq (TYPE,CODE,cur,nextval,MAX,inc) VALUES  ('client','$code',0,1,99,1)";
        mysqli_query($con,$stmt_seq);
       } 
    }
    echo"SAVED";
}
?>