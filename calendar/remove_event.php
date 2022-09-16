<?php 
 session_start();
   if (isset($_SESSION['username'])){
     include '../DB.php';
   if(isset($_POST['id'])){
      $id         = htmlspecialchars(trim($_POST['id']));
      $addAssignment = "delete from events where id = '$id'";

       if(mysqli_query($con,$addAssignment)){
           //this will be displayed when the query was successful
           echo "true";
       }else{
        echo "false";
            die("SQL: ".$addAssignment." >> ".mysqli_error($con));
       }
   }
}?>