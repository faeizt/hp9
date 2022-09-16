<?
if(isset($_POST['app_no'])){
	include '../DB.php';
	$app_no  		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['app_no'])));
	$id				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['id'])));
	$loc_name		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['loc_name'])));
	$addr_1 		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['addr_1'])));
	$addr_2 		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['addr_2'])));
	$postcode 		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['postcode'])));
	$city 			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['city'])));
	$state	 		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['state'])));

	if($id!=""){
		    $addPersonnel_address	=	"UPDATE address SET loc_name='$loc_name',addr_1='$addr_1', addr_2='$addr_2', postcode ='$postcode', city = '$city', state='$state' WHERE id='$id'";	
	}else{
			$addPersonnel_address	=	"INSERT INTO address (loc_name,addr_1, addr_2, postcode, city, state,personnel_id) ".
    									"VALUES('$loc_name','$addr_1','$addr_2','$postcode','$city','$state','$app_no')";
	}


			mysqli_query($con,$addPersonnel_address) or die('addr='. $addPersonnel_address);
		    echo"true,".$app_no.','.$id;

}
else{   echo "false";}//return auth value
?>