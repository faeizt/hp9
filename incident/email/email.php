<?php 
 session_start();
   if (isset($_SESSION['username'])){
		$case_id       = htmlspecialchars(trim($_POST['case_id']));
		$email         = htmlspecialchars(trim($_POST['email']));

		include '../../DB.php';

		$to            = $email;
		$from          = "support@examedia.com.my";
		$fromName      = "Examedia Support";
		$subject 	   = "New Incident ".$case_id;

		$caseInfo      = "SELECT * FROM v_incident i, vclientaddr a,v_project p  WHERE i.site_id = a.site_id AND i.project_code = p.project_code and case_id = '$case_id'";  
		$r_caseInfo    =  mysqli_query($con,$caseInfo) or die("sql= ". $caseInfo . mysqli_error($con));          
		$row_caseInfo  =  mysqli_fetch_array( $r_caseInfo );
		$client        =  $row_caseInfo['name'];
		$project       =  $row_caseInfo['project_name'];
		$caller        =  $row_caseInfo['caller'];
		$contact       =  $row_caseInfo['contact'];
		$info          =  $row_caseInfo['info'];
		$title         =  $row_caseInfo['title'];
		$problem       =  $row_caseInfo['problem'];
		$flag          =  $row_caseInfo['flag'];
		$product       =  $row_caseInfo['product'];
		$model         =  $row_caseInfo['model'];
		$sn            =  $row_caseInfo['sn'];
		$site_name	   =  $row_caseInfo['site_name'];
		$date          =  $row_caseInfo['DATE'];   
		$time          =  $row_caseInfo['time'];
		$address 	   =  $row_caseInfo['addr1'].", <br/>".$row_caseInfo['addr2'].", ".$row_caseInfo['postcode'].", <br/>".$row_caseInfo['city'].", ".$row_caseInfo['statename'];



   $message = <<<EndOfHtml
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">

			 <head>
			  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			  <title>Examedia Support Notification</title>
			  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			</head>
			<body style="margin: 0; padding: 0;">
			<style>
				td {border: 1px solid #ccc; width:300px}
			</style>
			<table border=1 cellpadding=2 style="width=100%">
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5">Incident ID </td><td style="width:400px">$case_id</td></tr>
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5">Client </td><td style="width:400px">$client</td></tr>
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5">Project </td><td>$project</td></tr>
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5">Contact Name</td><td>$caller</td></tr>	
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5">Contact Number</td><td>$contact</td></tr>
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5" valign="top">Site Address</td><td>$address</td></tr>
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5">Additional Contant Info</td><td>$info</td></tr>
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5">Equipment Model</td><td>$model</td></tr>
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5">Serial Number</td><td>$sn</td></tr>
			<tr><td style="width:150px;font-weight:bold;background:#f5f5f5">Problem </td><td>$problem</td></tr>
			</table>

			</body>
			</html>
EndOfHtml;
   $headers = "From:" . $from;
        require("../../mailer/class.phpmailer.php");

                     $html = true;


        $mail = new PHPMailer();
                     
        $mail->IsSMTP(); // send via SMTP
        $mail->Host = "smtp.gmail.com"; //SMTP server
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        //Set the SMTP port number - 465 for authenticated SSL, a.k.a. 
        $mail->Port = 465;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'ssl';
        //Whether to use SMTP authentication         

            $mail->SMTPAuth=true;
            $mail->Username=$from;
            $mail->Password='3x4m3d14';

            // $mail->SMTPAuth=false;

         $mail->SMTPDebug = 0;
        $mail->From = $from;
        $mail->FromName = $fromName;
        $mail->AddAddress($to);
        $mail->AddReplyTo($from);
         
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML($html);
        $mail->Subject  = $subject;
        $mail->Body = $message;
         
        if($mail->Send())
        {
            echo "Notification email successfully sent to ". $to;
        }
        else
        {
             echo "Message Not Sent<br>";
             echo "Mailer Error: " . $mail->ErrorInfo;
        }

}

?>