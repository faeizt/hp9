<?session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../index.html' ) ;
}
if(isset($_POST['client'])){
	include '../DB.php';
	$client        		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['client'])));
	$project  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project'])));
	$machine   			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['machine'])));
    $sn                 = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['sn'])));



    $addCase  = "INSERT INTO inventory (client_code,project_code,product_id,sn) VALUES ('$client','".$project."','".$machine."',UCASE('".$sn."'))";
    if (isset($_POST['id'])) {
    	$id = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['id'])));
    	$addCase  = "UPDATE inventory SET client_code = '$client', project_code='".$project."',product_id='".$machine."',sn=UCASE('$sn') where id = '$id'";
    }
    mysqli_query($con,$addCase) or die($addCase .mysqli_error($con));
    echo"SAVED";
}
?>