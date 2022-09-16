<?session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../index.html' ) ;
}
if(isset($_POST['code'])){
	include '../../DB.php';
	$code  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['code'])));
	$acronym  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['acronym'])));
	$name    			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['name'])));

    $addCase  = "INSERT INTO CLIENT (client_code,NAME,acronym) VALUES ('$code','".$name."','".$acronym."')";
    mysqli_query($con,$addCase) or die($addCase .mysqli_error($con));
    echo"SAVED";
}
?>