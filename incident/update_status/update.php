<?php 
 session_start();
   if (isset($_SESSION['username'])){
     include '../../DB.php';
   if(isset($_POST['case_id'])){
      $status			 = htmlspecialchars(trim($_POST['status']));
      $onsite		   = htmlspecialchars(trim($_POST['onsite']));
      $resolve     = htmlspecialchars(trim($_POST['resolve']));
      $remarks	   = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['remarks'])));
      $reso_type  = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['reso_type'])));
      $resolution  = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['resolution'])));
      $mod_by   = $_SESSION['username'];
      $case_id     = $_POST['case_id'];
      if ($resolve =='') {
      $addAssignment = "update cases set sts = '$status',onsite_time=STR_TO_DATE('".$onsite."', '%d/%m/%Y %H:%i'),remarks='$remarks',resolution_type='$reso_type',resolution='$resolution',mod_by='$mod_by',mod_date=now() where case_id= '$case_id'";
      }
      else{
      $addAssignment = "update cases set sts = '$status',onsite_time=STR_TO_DATE('".$onsite."', '%d/%m/%Y %H:%i'),resolve_time=STR_TO_DATE('".$resolve."', '%d/%m/%Y %H:%i'),remarks='$remarks',resolution_type='$reso_type',resolution='$resolution',mod_by='$mod_by',mod_date=now() where case_id= '$case_id'";

      }
      if ($status=='5') {
        $close_time = "update cases set close_date = now() where case_id = '$case_id'";
        mysqli_query($con,$close_time);
      }
      if ($status=='3') {
       $pending_time = "update cases set pending_time = now() where case_id = '$case_id'";
       mysqli_query($con,$pending_time);
      }
      
       $notification  = "INSERT INTO notification (case_id,case_status,user) VALUES('$case_id','$status','".$_SESSION['username']."')";
       mysqli_query($con,$notification) or die($notification .mysqli_error($con));    

       if(mysqli_query($con,$addAssignment)){
           //this will be displayed when the query was successful
           
       }else{
        echo "false";
            die("SQL: ".$addAssignment." >> ".mysqli_error($con));
       }
   }
}?>