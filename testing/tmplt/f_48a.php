<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Add custom CSS here -->
<link href="../css/sb-admin.css" rel="stylesheet">
<!-- JavaScript -->

<script src="../js/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>    
<script src="../js/bootstrap.js"></script>
<!-- Page Specific Plugins -->
<?
if(isset($_GET['app_no'])){
	include '../DB.php';
	$app_no		= 	htmlspecialchars(trim($_GET['app_no']));
	$comsec		= 	htmlspecialchars(trim($_GET['comsec']));

        $sqlquery   =   "SELECT * FROM v_app where app_no = '$app_no'";
        // echo $sqlquery;
        $result_app     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row_app        =   mysqli_fetch_array( $result_app );
}
?>
	<STYLE TYPE="text/css">
	@media all {
		#print_view_container{font-size: 12px;font-family: Times New Roman;}
		#print_view_container table {font-size:  11px;font-family: Times New Roman;}	
		.page-break	{ display: none; }
	}

	@media print {
		body {font-size: 11px;font-family: Times New Roman;}
		table {font-size:  11px;font-family: Times New Roman;}		
		.page-break	{ display: block; page-break-before: always; }
	}
	</STYLE>
<?php
//Director info
$director_query = "SELECT * FROM v_personnel WHERE app_no = '$app_no' AND FIND_IN_SET('1',role) > 0"; 
$director_result = mysqli_query($con,$director_query) or die(mysqli_error($con));
$director_num	=	mysqli_num_rows($director_result);
    $i=1;
    $total=$director_num-1;

while($director_row = mysqli_fetch_array($director_result)){?>     
<div id="print_view_container">
<DIV>
FORM 48A <BR>
<I>                        Companies Act, 1965</I><BR>
(Section 16 (3A) and 123 (4) ) <BR>
</DIV><BR>
Company No. 
<TABLE BORDER=1>
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>
<BR>
<DIV ALIGN=center><b>STATUTORY DECLARATION BY A PERSON BEFORE <BR>
APPOINTMENT AS DIRECTOR, OR BY A PROMOTER <BR>
BEFORE INCORPORATION OF CORPORATION </B><BR>
<BR>

  <?php
//Company Name
$query = "SELECT name, descr, if(status = 'false','Pending For Approval',if(status='true','Approved',status)) status FROM com_names where app_no='$app_no' and status = 'true'"; 
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$num	=	mysqli_num_rows($result);
$row = mysqli_fetch_array($result)?>		
 <u><b><?=$row['name']?></b></u> <?
 
?>

 </DIV><BR>
I, <?=$director_row['name']?>
 *I/C No. /*Passport No. <?=$director_row['ic']?> of 
<?=$director_row['addr_1']?> <?=$director_row['addr_2']?>, <?=$director_row['postcode']?> <?=$director_row['city']?>, <?=$director_row['state']?>  do solemnly and sincerely declare that - 
<BR>
<BR>
(1) 1 am not an undischarged bankrupt. <BR>
<BR>
(2) 1 have not been convicted whether within or without Malaysia of any offence <BR>
<UL>(a) in connection with the promotion, formation or management of a corporation; <BR>
(b) involving fraud or dishonesty punishable on conviction with imprisonment for three months or more, or <BR>
(c) under section 132, 132A or under section 303, within a period of five years preceding the date of this declaration. <BR>
</UL>(3) I have not been imprisoned for any offence referred to in paragraph (2) hereof within the period of five years immediately preceding the date of this declaration. <BR>
<BR>
*(4) 1 am an undischarged bankrupt but have been granted leave by the court under section 125 to act as a director of ...................................... (name of corporation) . <BR>
<BR>
*(5) 1 have been granted leave by the court under section 130 to be director of ...................................... (name of corporation) or a promoter of a proposed corporation...................................... (name of proposed corporation) or both a director of...................................... (name of corporation) and a promoter of ......................................  (name <I>of </I>proposed corporation) . I attach herewith an office copy <I>of </I>the court order. <BR>
<BR>
(6) 1 hereby consent to act as director of <?=$row['name']?> . 
<BR>
And I make this solemn declaration conscientiously believing the same to be true, and by virtue of the provisions of the &#8224; Statutory Declarations Act, 1960. <BR>
<BR>
Subscribed and solemnly declared by the above named <?=$director_row['name']?> at......................................  in the State of ......................................  this......................................  day of ......................................  ,19...................................... <BR>
<br/><br/><div style="width:100%;text-align:right">
Before me <br/>
.........................................	
</div>

<div style="width:100%;border-bottom:1px solid black;margin-top:10px"></div><BR>
This Statutory Declaration shall be lodged with the Registrar of Companies and the Official Receiver. <BR>
* Strike out whichever is inapplicable. <BR>
&#8224;If the declaration is made in another country, it must be made under the law relating to statutory declaration of oaths prevailing in that country.<BR>
<BR>
Lodged By:<br>
<?php

$comsec_query 	=   "SELECT address.*,a.*,n.name AS negeri FROM address ".
					"LEFT JOIN applications a ON app_no ='$comsec'  ".
					"LEFT JOIN states n ON state = n.id  ".
					"WHERE personnel_id = '$comsec' ".
					"ORDER BY address.id LIMIT 1"; 
			$comsec_result = mysqli_query($con,$comsec_query) or die(mysqli_error($con));
			$comsec_row = mysqli_fetch_array($comsec_result)
?>
<?=$comsec_row['com_name']?><br>
<?=$comsec_row['addr_1']?><br>
<?=$comsec_row['addr_2']?><br>
<?=$comsec_row['postcode']?> <?=$comsec_row['city']?><br>
<?=$comsec_row['negeri']?><br>
 Tel:09-2963620<br>
 Fax:09-2964620<br> 
<?
        if($i<=$total){echo"<p class=\"page-break\"></p>";}
        $i++;

}?>
</div>