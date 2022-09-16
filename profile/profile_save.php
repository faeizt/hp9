<?
include '../DB.php';
if(isset($_POST['username'])){
  $id      = htmlspecialchars(trim($_POST['id']));
	$username      = htmlspecialchars(trim($_POST['username']));
	$name          = htmlspecialchars(trim($_POST['name']));
	$designation   = htmlspecialchars(trim($_POST['designation']));
	$phone		     = htmlspecialchars(trim($_POST['phone']));
  $mobile         = htmlspecialchars(trim($_POST['mobile']));
	$email		     = htmlspecialchars(trim($_POST['email']));
  $role         = htmlspecialchars(trim($_POST['role']));  
  $specialization    = htmlspecialchars(trim($_POST['specialization']));
  $skillset    = htmlspecialchars(trim($_POST['skillset']));
  $password      = htmlspecialchars(trim($_POST['password']));  
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
                  $updt_passwd .
                  "     email        = '$email'". 
             
                  "where user_id    = '$id'";
    if(mysqli_query($con,$updateUser)){
        //this will be displayed when the query was successful
        echo "true";
    }else{
        die("SQL: ".$updateUser." >> ".mysqli_error($con));
    }
}
?>