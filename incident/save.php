<?
session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../index.html' ) ;
}
if(isset($_POST['client'])){
	include '../DB.php';
	$client  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['client'])));
	$project  			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project'])));
	$site    			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['site'])));
	$address			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['address'])));
	$report_channel		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['report_channel'])));
	$contact_person		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['contact_person'])));
	$contact_no			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['contact_no'])));
	$add_info			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['add_info'])));
	$title 				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['title'])));
	$description		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['description'])));
	$sn					= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['sn'])));
	// $asset				= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['asset'])));
	$service_type		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['service_type'])));
	$category			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['category'])));
	$machine			= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['machine'])));

	$sla	 			= 0;
	$severity 			= 0;
	$recurrence 		= mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['recurrence'])));


    if ($machine=="") $machine=0;

/*--New Case ID------------------------------------------------------*/
	$getNewCaseID		=	"SELECT getCaseID('$project') caseID FROM DUAL";
	$result_newCaseID	=	mysqli_query($con,$getNewCaseID) or die("sql= ". $getNewCaseID);          
	$row_newCaseID		=	mysqli_fetch_array( $result_newCaseID );
	$case_id		    =	$row_newCaseID['caseID'];
	//echo $getNewCaseID;
	//echo $case_id;
/*--New Case ID--------------------------------------------------*/


   $addCase  = "INSERT INTO cases (case_id,project_code, client_code,site_id,addr_id,caller,contact,info,via,servType,cat,item,product,sn,title,problem,sts,sla,flag,recurrence,open_by,open_date) ". 
                 "VALUES('$case_id','".$project."','".$client."','".$site."','".$address."','".$contact_person."','".$contact_no."','".$add_info."','".$report_channel."','".$service_type."','".$category."','','$machine',UCASE('".$sn."'), ".
                 "'".$title."','".$description."','0','".$sla."','".$severity."','".$recurrence."','".$_SESSION['username']."',now())";

				 mysqli_query($con,$addCase)or die(mysqli_error($con));
//echo $addCase;
    if( mysqli_query($con,$addCase)){
		require ('../notification/notification.php');
		$notifications 	= new notification();
		 
		global 			 $notifications;
		$actor 			= 	 $_SESSION['username'];
		$subject_id 	=    $notifications->getSubject('create',$case_id,$actor);
		$notifications->sendNotification($subject_id,$case_id);
    }else{mysqli_error($con);};
// mysql_query($addCase)or die(mysql_error());
    $stmt_seq = "UPDATE  seq	SET 	cur 	= cur + inc, 		nextval	= nextval + inc	WHERE 		TYPE	= 'project' 	AND	CODE 	= '$project'";
    mysqli_query($con,$stmt_seq);

    // $notification  = "INSERT INTO notification (case_id,user) VALUES('$case_id','".$_SESSION['username']."')";   
    // mysql_query($notification) or die($notification .mysql_error());    

    echo $case_id;
}
?>