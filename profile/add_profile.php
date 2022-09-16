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
  $role_id         = htmlspecialchars(trim($_POST['role']));  
  $license_no    = htmlspecialchars(trim($_POST['license_no']));
  $password      = htmlspecialchars(trim($_POST['password']));  



$addUser_sql="insert into sys_users (username,name,designation,phone,mobile,license_no,role_id,email,password) values ('$username','$name','$designation','$phone','$mobile','$license_no','$role_id','$email',md5('$password'))";                  
    if(mysqli_query($con,$addUser_sql)){
        //this will be displayed when the query was successful
        echo "true";
    }else{
        die("SQL: ".$addUser_sql." >> ".mysqli_error($con));
    }
}
?>