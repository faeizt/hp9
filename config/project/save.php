<?session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../../index.html' ) ;
}
if(isset($_POST['project_name'])){
	include '../../DB.php';

    $project_code           = "";
    $project_name           = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project_name'])));
    $project_descr          = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project_descr'])));
    $project_client         = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project_client'])));
    $project_contract       = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project_contract'])));
    $project_am             = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project_am'])));
    $project_pm             = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project_pm'])));
    $project_cpm            = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project_cpm'])));
    $project_startdate      = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project_start'])));
    $project_enddate        = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['project_end'])));

    /*--New Case ID------------------------------------------------------*/
    $getProjCode            =   "SELECT getProjCode('$project_client') project_code FROM DUAL";
    $result_ProjCode        =   mysqli_query($con,$getProjCode) or die("sql= ". $getProjCode);          
    $row_ProjCode           =   mysqli_fetch_array( $result_ProjCode );
    $project_code           = $row_ProjCode['project_code'];
    /*--New Case ID--------------------------------------------------*/


   $addProject      = "INSERT INTO project (project_code, project_name,project_descr, client_code,contract_code,accountmanager,projectmanager,clientpm,startdate,enddate) VALUES ".
                      "('$project_code','$project_name','$project_descr','$project_client','$project_contract','$project_am','$project_pm','$project_cpm',STR_TO_DATE('$project_startdate', '%d/%m/%Y'),STR_TO_DATE('$project_enddate', '%d/%m/%Y'))";
    if (isset($_POST['id'])) {
    	$id = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['id'])));
        $addProject      = "UPDATE project SET project_name='$project_name',project_descr='$project_descr', client_code='$project_client',contract_code='$project_contract',accountmanager='$project_am',projectmanager='$project_pm',clientpm='$project_cpm',startdate=STR_TO_DATE('$project_startdate', '%d/%m/%Y'),enddate=STR_TO_DATE('$project_enddate', '%d/%m/%Y') where id = '$id';";
        mysqli_query($con,$addProject) or die($addProject .mysqli_error($con));
    }else{
        if(mysqli_query($con,$addProject)){
            $stmt_proj_seq = "INSERT INTO seq (TYPE,CODE,cur,nextval,MAX,inc) VALUES ('project','$project_code',0,1,99999,1)";
            mysqli_query($con,$stmt_proj_seq);            
            $stmt_client_seq = "UPDATE  seq SET cur = cur + inc, nextval = nextval + inc WHERE TYPE = 'client' AND CODE = '$project_client'";
            mysqli_query($con,$stmt_client_seq); 

            $stmt_sla = "insert into sla (project_code,TYPE, name )VALUES('$project_code',0,'24X7X2')";
            mysqli_query($con,$stmt_sla) or die($stmt_sla .mysqli_error($con));

            $stmt_severity = "insert into severity (sla, severitylevel )VALUES((select max(id) from sla),0)";
            mysqli_query($con,$stmt_severity) or die($stmt_severity .mysqli_error($con));
            $stmt_severity = "insert into severity (sla, severitylevel )VALUES((select max(id) from sla),1)";
            mysqli_query($con,$stmt_severity) or die($stmt_severity .mysqli_error($con));
            $stmt_severity = "insert into severity (sla, severitylevel )VALUES((select max(id) from sla),2)";
            mysqli_query($con,$stmt_severity) or die($stmt_severity .mysqli_error($con));

        }
    }
    echo"SAVED";
}else{?><?}
?>