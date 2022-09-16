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
<div id="print_view_container">
<strong>FORM 44</strong><br/>
Companies Act, 1965<br/>
(Section 120 (1),<br/>
333 (1 A) &amp; 335 (1) (d)<br/>
<br/>
Company No. 
<TABLE BORDER=1 style="font-size:10px">
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>
<br/>
<p>
    <strong>NOTICE OF SITUATION OF REGISTERED OFFICE AND </strong><br/>
    <strong>OF OFFICE HOURS AND PARTICULARS OF CHANGES </strong><br/>
 </p>   
<?php
//Company Name
$query = "SELECT name, descr, if(status = 'false','Pending For Approval',if(status='true','Approved',status)) status FROM com_names where app_no='$app_no' and status = 'true'"; 
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$num    =   mysqli_num_rows($result);
$row = mysqli_fetch_array($result)
?>
    <strong><?=$row['name']?></strong>
<p>
    To the Registrar of Companies,
</p>
<p>
    <strong><?=$row['name']?></strong>    hereby gives notice that: - 
</p>
<?php
//office_location information
$office_location_query = "SELECT * FROM address WHERE personnel_id='$app_no'"; 
// echo $office_location_query ;
$office_location_result = mysqli_query($con,$office_location_query) or die(mysqli_error($con));
$office_location_num    =   mysqli_num_rows($office_location_result);
$office_location_row = mysqli_fetch_array($office_location_result)?> 

<p>
    *as from the date of incorporation the registered office of the company in Malay has been situated at No <?=$office_location_row['addr_1']?> <?=$office_location_row['addr_2']?>, <?=$office_location_row['postcode']?> <?=$office_location_row['city']?>, <?=$office_location_row['state']?>.
</p>
<p>
    <s>
        *as from the ..........................................day of.............................., 20..............................the registered office the
        company in Malaysia has been situated at ‡..............................
    </s>
</p>
<p>
    <s>
    </s>
</p>
<p>
    <s>
        *as from the........................ day of................ 20 the situation of the registered office of the company has been changed from
        ‡........................... to ‡..............................
    </s>
</p>
<p>
    *As from the <?=$row_app['incorporation_date']?> the day and hours during which that office is open and accessible to the public have been as follows :-
</p>
<p>
<?=nl2br($row_app['business_hour'])?>
</p>
<p>
    Dated this:
</p>
<br clear="ALL"/>
<?php
//secretary information
$secretary_query = "SELECT * FROM v_personnel WHERE id = (SELECT secretary FROM v_app WHERE app_no='$app_no')"; 
// echo $secretary_query ;
$secretary_result = mysqli_query($con,$secretary_query) or die(mysqli_error($con));
$secretary_num  =   mysqli_num_rows($secretary_result);
$secretary_row = mysqli_fetch_array($secretary_result)?> 
<table style="font-size:12px; width:100%">
    <tr><td style="width:40%"></td><td style="width:20%"></td><td style="border-bottom:1px solid black;width:40%">   </td></tr>
    <tr><td></td><td style="width:150px"></td><td><?=$secretary_row['name']?> <br>(<?=$secretary_row['license_no']?>)<br>Company Secretary  </td></tr>

</table>
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