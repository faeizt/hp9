<?php session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../../index.html' ) ;
}
if(isset($_POST['user_id'])){
	include '../../../DB.php';

  $user_id           = htmlspecialchars(trim($_POST['user_id']));
  $access            = htmlspecialchars(trim($_POST['access']));
  $access2           = htmlspecialchars(trim($_POST['access2']));
  $access3           = htmlspecialchars(trim($_POST['access3']));

  $addUser  = " UPDATE sys_users SET access = '$access', access2 = '$access2', access3 = '$access3' WHERE user_id = '$user_id'";

        if (mysqli_query($con,$addUser))  {
            echo"SAVED";
        }else{
            echo $addUser;
        }
    // }
}else{?>fasfas<?php }
?>