<?session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../../index.html' ) ;
}
if(isset($_POST['user_id'])){
	include '../../../DB.php';

  $user_id          = htmlspecialchars(trim($_POST['user_id']));
  $client_code     = htmlspecialchars(trim($_POST['client_code']));
  $project_code     = htmlspecialchars(trim($_POST['project_code']));
  $role             = htmlspecialchars(trim($_POST['role']));
  $access             = htmlspecialchars(trim($_POST['access']));


    if (isset($_POST['id']) && $_POST['id']!='') {
        $ac      = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['id'])));
        $updateUser   = "update sys_user_ac set client_code='$client_code', project_code = '$project_code',access = '$access',role='$role',access='$access' where id = '$ac' ";        
      if (mysqli_query($con,$updateUser))  {
          echo"SAVED";
      }else{
          echo $updateUser;
      }    
    }else{
   $addUser  = "INSERT INTO sys_user_ac (user_id,client_code,project_code,role,access) VALUES ('$user_id','$client_code','$project_code','$role','$access')";
        if (mysqli_query($con,$addUser))  {
            echo"SAVED";
        }else{
            echo $addUser;
        }
    }
}else{?>fasfas<?}
?>