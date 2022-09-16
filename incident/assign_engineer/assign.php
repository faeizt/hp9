<?php 
 session_start();
   if (isset($_SESSION['username'])){
     include '../../DB.php';
   if(isset($_POST['case_id'])){
      $case_id				= htmlspecialchars(trim($_POST['case_id']));
      $user_id		   = htmlspecialchars(trim($_POST['engineer']));
      $engineer_name       = htmlspecialchars(trim($_POST['engineer_name']));
      $assign_note	= htmlspecialchars(trim($_POST['note']));
      $assign_by     = $_SESSION['username'];


      $addAssignment = "INSERT INTO assignment (case_id,user_id,assign_by, assign_date,assign_note) VALUES ('".$case_id."','".$user_id."','$assign_by',now(),'".$assign_note."')";
       if(mysqli_query($con,$addAssignment)){
          $updateCase = "update cases set sts = '6',engineer = '$user_id',assign_time= now() where case_id='$case_id'";
          mysqli_query($con,$updateCase);

      require ('../../notification/notification.php');
      $notifications  = new notification();
       
      global       $notifications;
      $actor      =    $_SESSION['username'];
      $subject_id   =    $notifications->getSubject('assign',$case_id,$actor);
      $notifications->sendNotification($subject_id,$case_id);

       // $notification  = "INSERT INTO notification (case_id,case_status,user) VALUES('".$case_id."','6','".$_SESSION['username']."')";
       // mysqli_query($con,$notification) or die($notification .mysqli_error($con));    

           //this will be displayed when the query was successful
           echo "true";
       }else{
           die("SQL: ".$addAssignment." >> ".mysqli_error($con));
       }
   }
}?>