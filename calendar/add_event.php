<?php 
 session_start();
   if (isset($_SESSION['username'])){
     include '../DB.php';
   if(isset($_POST['id'])){
      $id         = htmlspecialchars(trim($_POST['id']));
      $project     =htmlspecialchars(trim($_POST['project']));
      $begin			 = htmlspecialchars(trim($_POST['begin']));
      $end		   = htmlspecialchars(trim($_POST['end']));
      $allDay     = htmlspecialchars(trim($_POST['allDay']));
      $title	   = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['title'])));

      if ($id =='') {
                $addAssignment = "insert into events (owner,title,begin,end,allDay) values ('$project','$title',STR_TO_DATE('".$begin."', '%d/%m/%Y %H:%i'),STR_TO_DATE('".$end."', '%d/%m/%Y %H:%i'),'$allDay')";
      }
      else{
                $addAssignment = "update events set title = '$title',begin = STR_TO_DATE('".$begin."', '%d/%m/%Y %H:%i'), end = STR_TO_DATE('".$end."', '%d/%m/%Y %H:%i'),allday = '$allDay' where id = '$id'";

      }

       if(mysqli_query($con,$addAssignment)){
           //this will be displayed when the query was successful
           echo "true";
       }else{
        echo "false";
            die("SQL: ".$addAssignment." >> ".mysqli_error($con));
       }
   }
}?>