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
	.table-bordered-black td{border:1px solid black;padding:10px;}
	.table-bordered-black th{border:1px solid black;padding:10px;}

	.table-bordered-black {border: 1px solid black;padding:10px;}	

		@media all {
			.page-break	{ display: none; }
 		}

		@media print {
			body {font-size: 40%;font-family: Times New Roman;}
			.page-break	{ display: block; page-break-before: always; }

		}
	</STYLE>
<body id="print">
<DIV ALIGN=center>
<FONT SIZE=2 FACE="Times New Roman">FORM 6</FONT></DIV><DIV ALIGN=center><FONT SIZE=2 FACE="Times New Roman">Companies Act 1965</FONT><BR>
<FONT SIZE=2 FACE="Times New Roman">(Section 16 (2)</FONT></DIV><BR>
<FONT SIZE=2 FACE="Times New Roman">Company No.</FONT><BR>
<BR>

<TABLE style="border: 1px solid black">
<TR VALIGN=top><TD ><FONT SIZE=2 FACE="Times New Roman"><?=$row_app['com_ref_no']?></FONT></TD></TR>
</TABLE>

<DIV ALIGN=center><FONT SIZE=2 FACE="Times New Roman">DECLARATION OF COMPLIANCE</FONT></DIV><DIV ALIGN=center><FONT SIZE=2 FACE="Times New Roman">

<?php
//Company Name
$query = "SELECT name, descr, if(status = 'false','Pending For Approval',if(status='true','Approved',status)) status FROM com_names where app_no='$app_no' and status = 'true'"; 
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$num	=	mysqli_num_rows($result);
$row = mysqli_fetch_array($result)?>		
 <u><?=$row['name']?></u> <?
 
?>

</FONT></DIV><BR>
<BR>
<?php
//secretary information
$secretary_query = "SELECT * FROM v_personnel WHERE id = (SELECT secretary FROM v_app WHERE app_no='$app_no')"; 
// echo $secretary_query ;
$secretary_result = mysqli_query($con,$secretary_query) or die(mysqli_error($con));
$secretary_num	=	mysqli_num_rows($secretary_result);
$secretary_row = mysqli_fetch_array($secretary_result)?>		

<?php
//secretary_location information
$secretary_location_query = "SELECT * FROM address WHERE id = (SELECT location FROM v_app WHERE app_no='$app_no')"; 
// echo $secretary_location_query ;
$secretary_location_result = mysqli_query($con,$secretary_location_query) or die(mysqli_error($con));
$secretary_location_num	=	mysqli_num_rows($secretary_location_result);
$secretary_location_row = mysqli_fetch_array($secretary_location_result)?>		


<?php
//office_location information
$office_location_query = "SELECT * FROM address WHERE personnel_id='$app_no'"; 
// echo $office_location_query ;
$office_location_result = mysqli_query($con,$office_location_query) or die(mysqli_error($con));
$office_location_num	=	mysqli_num_rows($office_location_result);
$office_location_row = mysqli_fetch_array($office_location_result)?>	

<FONT SIZE=2 FACE="Times New Roman">I, </FONT><FONT SIZE=2 FACE="Times New Roman"><U><?=$secretary_row['name']?>	</U></FONT><FONT SIZE=2 FACE="Times New Roman">,*I/C No./ Passport No . </FONT><FONT SIZE=2 FACE="Times New Roman"><U><?=$secretary_row['ic']?></U>, 
of &nbsp;<U><?=$secretary_location_row['addr_1']?> <?=$secretary_location_row['addr_2']?>, <?=$secretary_location_row['postcode']?> <?=$secretary_location_row['city']?>, <?=$secretary_location_row['state']?></U></FONT><FONT SIZE=2 FACE="Times New Roman"> sincerely declare the following:</FONT><BR>
<BR>
<FONT SIZE=2 FACE="Times New Roman">1. I am the person named in the articles as the first secretary of </FONT> <FONT SIZE=2 FACE="Times New Roman"><U><?=$row['name']?></U></FONT><FONT SIZE=2 FACE="Times New Roman"> </FONT><BR>
<BR>
<FONT SIZE=2 FACE="Times New Roman">2. All the requirements of the Companies Act 1965 and of the Companies Regulations in respect of matters precedent to the registration of the company and incidental to its registration have been complied with.</FONT><BR>
<BR>
<FONT SIZE=2 FACE="Times New Roman">3. As from the date of its incorporation, the registered office of the company will be situated at  <U><?=$office_location_row['addr_1']?> <?=$office_location_row['addr_2']?>, <?=$office_location_row['postcode']?> <?=$office_location_row['city']?>, <?=$office_location_row['state']?></U> </FONT><BR>
<BR>
<FONT SIZE=2 FACE="Times New Roman">4. The first directors named in the articles of the company are as follows:</FONT><BR>


<TABLE class=" table-bordered-black" WIDTH=100% style="">
<TR VALIGN=top><TH ><FONT SIZE=2 FACE="Times New Roman"># Name</FONT></TH><TH><FONT SIZE=2 FACE="Times New Roman">Address</FONT></TH><TH><FONT SIZE=2 FACE="Times New Roman">I/C / Passport </FONT></TH><TH><FONT SIZE=2 FACE="Times New Roman">Date Of Birth</FONT></TH></TR>
<?php

			$personnel_query = "SELECT `salutation`,`name`,`ic`,`nationality`,`race`,`dob`,`age`,`sex`,`phone_office`,`phone_hp`,`fax`,`email`,addr_1,addr_2,postcode,city, state FROM v_personnel WHERE FIND_IN_SET('1',role) > 0 and app_no='$app_no'"; 
			$personnel_result = mysqli_query($con,$personnel_query) or die(mysqli_error($con));
			$personnel_num	=	mysqli_num_rows($personnel_result);
			$i = 1;
			if($personnel_num>0){?>	<?
			while($personnel_row = mysqli_fetch_array($personnel_result)){?>		
				<TR VALIGN=top>
					<TD style="width:200px" >
						<FONT SIZE=2 FACE="Times New Roman"><?=$personnel_row['name']?></FONT>
					</TD>
					<TD style="width:200px">
						<FONT SIZE=2 FACE="Times New Roman"><?=$personnel_row['addr_1']?><br> <?=$personnel_row['addr_2']?><br/> <?=$personnel_row['postcode']?> <?=$personnel_row['city']?><br/> <?=$personnel_row['state']?></FONT>
					</TD>
					<TD style="width:120px"><FONT SIZE=2 FACE="Times New Roman"><?=$personnel_row['ic']?></FONT></TD>
					<TD style="width:100px"><FONT SIZE=2 FACE="Times New Roman"><?=$personnel_row['dob']?></FONT></TD>
				</TR>
	          
	          <?
	            $i++;
	        }
	    }?>

</TABLE>
<FONT SIZE=2 FACE="Times New Roman">5. The principal objects for which the company is incorporated are as follows:</FONT><BR>
<BR>
<FONT SIZE=2 FACE="Times New Roman">
<ol type="1">
<?php

			$activity_query = "SELECT activity_name, activity_descr FROM com_activities where app_no='$app_no'"; 
			$activity_result = mysqli_query($con,$activity_query) or die(mysqli_error($con));
			$activity_num	=	mysqli_num_rows($activity_result);
			$i = 1;
			if($activity_num>0){?>	<?
			while($activity_row = mysqli_fetch_array($activity_result)){?>		
	          <li style=""><?=$activity_row['activity_name']?></li><?
	            $i++;
	        }
	    }?>
</ol>
</FONT>
<FONT SIZE=2 FACE="Times New Roman">6. The authorised capital of the company is RM </FONT><FONT SIZE=2 FACE="Times New Roman"><u>
<?=$row_app['capital']?></u></FONT><FONT SIZE=2 FACE="Times New Roman"> divided into </FONT><FONT SIZE=2 FACE="Times New Roman"><u><?=$row_app['numberofshares']?></u></FONT><FONT SIZE=2 FACE="Times New Roman"> shares of RM </FONT><FONT SIZE=2 FACE="Times New Roman"><u><?=$row_app['priceperunit']?></u> </FONT><FONT SIZE=2 FACE="Times New Roman">each.</FONT><BR>
<BR>
<FONT SIZE=2 FACE="Times New Roman">Declared at </FONT><FONT SIZE=2 FACE="Times New Roman"><u> <?=$secretary_location_row['addr_1']?> <?=$secretary_location_row['addr_2']?>, <?=$secretary_location_row['postcode']?> <?=$secretary_location_row['city']?>, <?=$secretary_location_row['state']?></u> </FONT><FONT SIZE=2 FACE="Times New Roman">this</FONT><FONT SIZE=2 FACE="Times New Roman">..................................... </FONT><FONT SIZE=2 FACE="Times New Roman">day of</FONT><FONT SIZE=2 FACE="Times New Roman">.....................................</FONT><BR>
<DIV ALIGN=right><FONT SIZE=2 FACE="Times New Roman">........................................................</FONT><BR>
<I><FONT SIZE=2 FACE="Times New Roman">(Name)<?=$secretary_row['name']?></FONT></I><BR>
<I><FONT SIZE=2 FACE="Times New Roman">(*Licence No./ Prescribed </FONT></I>	
<I><FONT SIZE=2 FACE="Times New Roman">Body Membership No.) <?=$secretary_row['license_no']?></FONT></I></DIV>
<div style="width:100%;border-bottom:1px solid black;margin-top:10px"></div><BR>
<FONT SIZE=2 FACE="Times New Roman">*Strike out whichever is inapplicable.</FONT><BR>
<FONT SIZE=2 FACE="Times New Roman"># If the director is of the female gender, insert &quot;(f)&quot; against her name.</FONT><BR>
<BR>
<FONT SIZE=2 FACE="Times New Roman"></FONT><FONT SIZE=2 FACE="Times New Roman"><u>Lodged By:<br>
<?php
$comsec_query 	=   "SELECT address.*,a.*,n.name AS negeri FROM address ".
					"LEFT JOIN applications a ON app_no ='$comsec'  ".
					"LEFT JOIN states n ON state = n.id  ".
					"WHERE personnel_id = '$comsec' ".
					"ORDER BY address.id LIMIT 1"; 
					// echo $comsec_query;
$comsec_result 	= mysqli_query($con,$comsec_query) or die(mysqli_error($con));
$comsec_row 	= mysqli_fetch_array($comsec_result)
?>
<?=$comsec_row['com_name']?><br>
<?=$comsec_row['addr_1']?><br>
<?=$comsec_row['addr_2']?><br>
<?=$comsec_row['postcode']?> <?=$comsec_row['city']?><br>
<?=$comsec_row['negeri']?><br>
 Tel:09-2963620<br>
 Fax:09-2964620<br>
</u> </FONT>
</body>
</HTML>
