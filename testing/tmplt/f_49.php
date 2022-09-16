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
    $app_no     =   htmlspecialchars(trim($_GET['app_no']));
    $comsec     =   htmlspecialchars(trim($_GET['comsec']));

        $sqlquery   =   "SELECT * FROM v_app where app_no = '$app_no'";
        // echo $sqlquery;
        $result_app     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row_app        =   mysqli_fetch_array( $result_app );
}
?>
    <STYLE TYPE="text/css">
    .table-bordered-black td{border:1px solid black;padding:5px;}
    .table-bordered-black th{border:1px solid black;padding:5px;text-align:center;font-weight: bold}

    .table-bordered-black {border: 1px solid black;padding:10px;}   

    @media all {
        #print_view_container{font-size: 12px;font-family: Times New Roman;}
        #print_view_container table {font-size:  11px;font-family: Times New Roman;}    
        .page-break { display: none; }
    }

    @media print {
        body {font-size: 12px;font-family: Times New Roman;}
        table {font-size:  12px;font-family: Times New Roman;}      
        .page-break { display: block; page-break-before: always; }
    }
    </STYLE>
<div id="#print_view_container">
<p>
    <strong>FORM 49</strong><br/>
    Companies Act, 1965<br/>
    (Section 141(6))
</p>
Company No. 
<TABLE BORDER=1>
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>
<br clear="ALL"/>
<p>
    RETURN GIVING PARTICULARS IN REGISTER OF DIRECTORS, MANAGERS AND SECRETARIES AND CHANGES OF PARTICULARS
</p>
<p align="center">
<?php
//Company Name
$query = "SELECT name, descr, if(status = 'false','Pending For Approval',if(status='true','Approved',status)) status FROM com_names where app_no='$app_no' and status = 'true'"; 
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$num    =   mysqli_num_rows($result);
$row = mysqli_fetch_array($result)
?>
    <strong> <u><b><?=$row['name']?></b></u> </strong></p>
<p align="center">
    DIRECTORS
</p>
<TABLE class="table-bordered-black">
<TR VALIGN=top>
	<TH>Fullname</TH>
	<th>Nationality & Race</th>
	<th>Date of Birth</th>
	<th>Residential Address</th>
	<th>Business Occupation</th>
	<th>Particulars of other Directorships</th>
	<th>Nature of Appointment of Change and Relevant Date</th>
	<TH>Identity Card No</TH>
</TR>
<?php

			$personnel_query = "SELECT `salutation`,`name`,`ic`,`nationality`,`race`,`dob`,`age`,`sex`,`phone_office`,`phone_hp`,`fax`,`email`,addr_1,addr_2,postcode,city, state FROM v_personnel WHERE FIND_IN_SET('1',role) > 0 and app_no='$app_no'"; 
			$personnel_result = mysqli_query($con,$personnel_query) or die(mysqli_error($con));
			$personnel_num	=	mysqli_num_rows($personnel_result);
			$i = 1;
			if($personnel_num>0){?>	<?
			while($personnel_row = mysqli_fetch_array($personnel_result)){?>		
				<TR VALIGN=top>
					<TD >
						<FONT SIZE=2 FACE="Times New Roman"><?=$personnel_row['name']?>
					</TD>
					<td><?=$personnel_row['nationality']?></p><p><?=$personnel_row['race']?></td>
					<TD style="width:100px"><FONT SIZE=2 FACE="Times New Roman"><?=$personnel_row['dob']?></TD>
					<TD style="width: 150px;">
						<FONT SIZE=2 FACE="Times New Roman"><?=$personnel_row['addr_1']?><br/><?=$personnel_row['addr_2']?><br/><?=$personnel_row['postcode']?> <?=$personnel_row['city']?><br/><?=$personnel_row['state']?>
					</TD>
					<td></td>
					<td></td>
					<td></td>

					<TD style="width:100px"><FONT SIZE=2 FACE="Times New Roman"><?=$personnel_row['ic']?></TD>
				</TR>
	          
	          <?
	            $i++;
	        }
	    }?>

</TABLE>


<p class="page-break"></p>

Company No. 
<TABLE BORDER=1>
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>
<br clear="ALL"/>
    <p align="center">
        <strong>FORM 49</strong><br/>
        Companies Act, 1965<br/>
        Section 141(6)
    </p>
    <p align="center">DIRECTORS</p>
    <p align="center">MANAGERS AND SECRETARIES*</p>

<table class="table-bordered-black">
    <tbody>
        <tr>
            <th>Office in Company</th>
            <th style="width:200px">Full Name</th>
            <th>
                Nationality/<br/>
                Race
            </th>
            <th style="width:200px">Residential Address</th>
            <th>
                Other<br/>
                Occupation<br/>
                (if any)
            </th>
            <th>
                Nature of Appointment<br/>
                or change and<br/>
                Relevant Date #
            </th>
            <th style="width:100px">Identity Card No.</th>
        </tr>
        <tr>
            <td>Managers</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php
        //secretary information
        $secretary_query = "SELECT * FROM v_personnel WHERE id = (SELECT secretary FROM v_app WHERE app_no='$app_no')"; 
        // echo $secretary_query ;
        $secretary_result = mysqli_query($con,$secretary_query) or die(mysqli_error($con));
        $secretary_num  =   mysqli_num_rows($secretary_result);
        $secretary_row = mysqli_fetch_array($secretary_result)?> 

        <?php
        //secretary_location information
        $secretary_location_query = "SELECT * FROM address WHERE id = (SELECT location FROM v_app WHERE app_no='$app_no')"; 
        // echo $secretary_location_query ;
        $secretary_location_result = mysqli_query($con,$secretary_location_query) or die(mysqli_error($con));
        $secretary_location_num =   mysqli_num_rows($secretary_location_result);
        $secretary_location_row = mysqli_fetch_array($secretary_location_result)?>       


        <tr>
            <td>Secretaries</td>
            <td><?=$secretary_row['name']?> <br>(<?=$secretary_row['license_no']?>)</td>
            <td><?=$secretary_row['nationality']?><br/><?=$secretary_row['race']?></td>
            <td>
               <?=$secretary_location_row['addr_1']?><br/> 
               <?=$secretary_location_row['addr_2']?><br/>
               <?=$secretary_location_row['postcode']?> <?=$secretary_location_row['city']?><br/>
               <?=$secretary_location_row['state']?>
            </td>
            <td>Company Secretary</td>
            <td>First Secretary as per named in the Articles of Association</td>
            <td><?=$secretary_row['ic']?> </td>
        </tr>
    </tbody>
</table>
<p>
    Date:
</p>
<p>
    LODGED BY:-
<?php

$comsec_query   =   "SELECT address.*,a.*,n.name AS negeri FROM address ".
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
 </p>
 </div>