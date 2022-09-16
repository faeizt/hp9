<?php 

$ds          = DIRECTORY_SEPARATOR;  //1

 

$storeFolder = '../images/uploads';   //2

 

if (!empty($_FILES)) {

     

    $tempFile = $_FILES['file']['tmp_name'];          //3              


    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

     

    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
      $size = $_FILES['file']['size'];
      $name = $_FILES['file']['name'];  //
 	  $case_id =  $_POST['case_id'];

    move_uploaded_file($tempFile,$targetFile); //6

    include '../DB.php';
   $addCase  = "INSERT INTO evidence (case_id,name,size) ". 
                 "VALUES('$case_id','$name','$size')";
    mysqli_query($con,$addCase) or die($addCase .mysqli_error($con));
    echo"SAVED";
}

?>      
