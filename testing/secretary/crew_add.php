<?
if(isset($_POST['app_no'])){
	include '../DB.php';
	$app_no  		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['app_no'])));
	$role	= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['role'])));
	$id				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['id'])));
	$salutation		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['salutation'])));
	$name		   	= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['name'])));
	$designation		   	= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['designation'])));
	$ic				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['ic'])));
	$nationality	= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['nationality'])));
	$race		   	= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['race'])));
	$sex			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['sex'])));
	$phone_office	= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['phone_office'])));
	$phone_hp		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['phone_hp'])));
	$email			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['email'])));
	$license_no		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['license_no'])));

	if($id!=""){
	$addPersonnel  			= 	"UPDATE com_personnel SET salutation = '$salutation', name= '$name',designation='$designation', ic= '$ic', nationality= '$nationality',race= '$race',sex= '$sex',phone_office= '$phone_office',phone_hp= '$phone_hp',license_no= '$license_no',email= '$email' WHERE id = '$id'";
	}else{
   	$addPersonnel  			= 	"INSERT INTO com_personnel (role,salutation,name,designation,ic,nationality,race,sex,phone_office,phone_hp,license_no,email,app_no) ". 
                 	 			"VALUES('$role','$salutation','$name','$designation','$ic','$nationality','$race','$sex','$phone_office','$phone_hp','$license_no','$email','$app_no')";
	}
			mysqli_query($con,$addPersonnel) or die('addr='. $addPersonnel);
			//begin get lates personnel id
			if($id 	==""){
		        $sqlquery   	=   "SELECT max(id) id FROM com_personnel";        
			    $result     	=   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
			    $row        	=   mysqli_fetch_array( $result );
			    $id 	= 	$row['id'];
			}
			//end of get latest personnel id			
		    echo"true,".$app_no.','.$id;

}
else{   echo "false";}//return auth value
?>