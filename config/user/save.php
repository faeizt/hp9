<?php session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../../index.html' ) ;
}
if(isset($_POST['username'])){
	include '../../DB.php';

    $username      = htmlspecialchars(trim($_POST['username']));
    $name          = htmlspecialchars(trim($_POST['name']));
    $designation   = htmlspecialchars(trim($_POST['designation']));
    $phone           = htmlspecialchars(trim($_POST['phone']));
    $mobile         = htmlspecialchars(trim($_POST['mobile']));
    $email           = htmlspecialchars(trim($_POST['email']));
    $role         = htmlspecialchars(trim($_POST['role']));  
    $access         = htmlspecialchars(trim($_POST['access']));  
    $access2         = htmlspecialchars(trim($_POST['access2']));  
    $specialization    = htmlspecialchars(trim($_POST['specialization']));
    $skillset    = htmlspecialchars(trim($_POST['skillset']));
    $password      = htmlspecialchars(trim($_POST['password']));  


    if (isset($_POST['user_id']) && isset($_POST['user_id'])) {
        $user_id = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['user_id'])));
          $updt_passwd   ="";
          if ($password != 'dmmypaswd'){$updt_passwd="     password        = md5('$password'), ";}
          $updateUser  =  "update sys_users ".
                          "set  name         = '$name',". 
                          "     designation  = '$designation',". 
                          "     phone        = '$phone',". 
                          "     mobile        = '$mobile',". 
                          "     specialization  = '$specialization',". 
                          "     skillset  = '$skillset',". 
                          "     role_id  = '$role',". 
                          "     access  = '$access',". 
                          "     access2  = '$access2',". 
                          $updt_passwd .
                          "     email        = '$email'". 
                     
                          "where user_id    = '$user_id'";        
        if (mysqli_query($con,$updateUser))  {
            echo"SAVED";
        }else{
            echo $updateUser;
        }    
    }else{
   $addUser  = "INSERT INTO sys_users (username,name,designation,phone,mobile,email,role_id,access,access2,specialization,skillset,password) VALUES ('$username','$name','$designation','$phone','$mobile','$email','$role','$access','$access2','$specialization','$skillset','".md5($password)."')";
        if (mysqli_query($con,$addUser))  {
            echo"SAVED";
        }else{
            echo $addUser;
        }

    }


}else{?><?php }
?>