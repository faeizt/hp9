<?php session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../index.html' ) ;
}
if(isset($_POST['category'])){
	include '../../DB.php';
	$category_id  				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['category_id'])));
	$category  			      = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['category'])));
	$category_description = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['category_description'])));

  // $code         = str_replace('\\', '', $code);

    if (isset($_POST['category_id'])) {
    	$category_id = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['category_id'])));
    	$addCase  = "UPDATE code_definition SET code_name = '$category', descr='".$category_description."' where code_definition_id = '$category_id'";
        mysqli_query($con,$addCase) or die($addCase .mysqli_error($con));
    }else{

      $sqlquery         =   "SELECT (MAX(CODE)+1) seq FROM CODE_DEFINITION WHERE code_cat='servicecat'"  ;      // echo $sqlquery;
      $result           =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
      $row              =   mysqli_fetch_array( $result );
      $seq = $row['seq'];
      $addCase  = "INSERT INTO code_definition (code_cat,code,code_name,descr) VALUES ('servicecat','".$seq."','".$category."','".$category_description."')";
       mysqli_query($con,$addCase) or die($addCase .mysqli_error($con));
    }
    echo"SAVED";
}
?>