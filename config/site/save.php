<?session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../../index.html' ) ;
}
if(isset($_POST['client'])){
	include '../../DB.php';

    $addr1      = htmlspecialchars(trim($_POST['addr_1']));
    $addr2      = htmlspecialchars(trim($_POST['addr_2']));
    $postcode   = htmlspecialchars(trim($_POST['postcode']));
    $city       = htmlspecialchars(trim($_POST['city']));
    $state      = htmlspecialchars(trim($_POST['state']));

    $client_code= htmlspecialchars(trim($_POST['client']));
    $project_code= htmlspecialchars(trim($_POST['project']));
    $site_name  = htmlspecialchars(trim($_POST['name']));
    $user_id    = 0;

/*--getting addr_id------------------------------------------------------*/
    $getMaxID       =   "SELECT getMaxAddrid() maxID FROM DUAL";
    $result_maxID   =   mysqli_query($con,$getMaxID) or die("sql= ". $getMaxID);          
    $row_maxID      =   mysqli_fetch_array( $result_maxID );
    $addr_id        =   $row_maxID['maxID'];
/*--end of getting addr--------------------------------------------------*/
    if (isset($_POST['addr_id']) && isset($_POST['site_id'])) {
        $addr_id = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['addr_id'])));
        $site_id = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['site_id'])));
        $updateAddress      = "UPDATE address SET addr1='$addr1',addr2='$addr2', postcode='$postcode',city='$city',state='$state' where addr_id = '$addr_id';";
        $updateSite         = "UPDATE client_site set client_code = '$client_code',project_code='$project_code',site_name='$site_name' where site_id = '$site_id'";
        if (mysqli_query($con,$updateAddress) &&  mysqli_query($con,$updateSite))  {
            echo"SAVED";
        }else{
            echo $updateAddress . "\n". $updateSite;
        }    
    }else{
       $addAddress  = "INSERT INTO address (addr_id, addr1,addr2,postcode,city,state) VALUES ('".$addr_id."','".$addr1."','".$addr2."','".$postcode."','".$city."','".$state."')";
       $addSite     = "INSERT INTO client_site (client_code,project_code,addr_id,site_name,user_id) VALUES ('".$client_code."','".$project_code."','".$addr_id."','".$site_name."','".$user_id."')";
        if (mysqli_query($con,$addAddress) &&  mysqli_query($con,$addSite))  {
            echo"SAVED";
        }else{
            echo $addAddress . "\n". $addSite;
        }

    }


}else{?><?php }
?>