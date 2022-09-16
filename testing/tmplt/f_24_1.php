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
    .table-bordered-black td{border:1px solid black;padding:10px;}
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
<div>    
<p>
    <strong>FORM 24</strong><br/>
    Companies Act, 1965<br/>
    Section 54 (1)
    </p>
Company No. 
<TABLE BORDER=1 >
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>
<a name="_GoBack"></a>
<br clear="ALL"/>
<p>
    <strong>RETURN OF ALLOTMENT OF SHARES </strong>
</p>
<p>
    <strong></strong>
</p>
<p>
   <?php
//Company Name
$query = "SELECT name, descr, if(status = 'false','Pending For Approval',if(status='true','Approved',status)) status FROM com_names where app_no='$app_no' and status = 'true'"; 
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$num    =   mysqli_num_rows($result);
$row = mysqli_fetch_array($result)
?>
    <strong> <u><b><?=$row['name']?></b></u> </strong>
</p>
<p>
    The shares referred to in this return were allotted (1) *on the 26<sup>th </sup>day of November , 2012./*
    <s>
        between the day of ,20 /*and the day of ,20
    </s>
</p>
<table class="table-bordered-black" >
    <tbody>
        <tr>
            <th width="50%" valign="top">(2) Shares Alloted</th>
            <th width="50%" colspan="3" valign="top">Details Of Shares</th>
        </tr>
        <tr>
            <th width="285" valign="top">
            </th>
            <th width="119" valign="top">Preference</th>
            <th width="104" valign="top">Ordinary</th>
            <th width="108" valign="top">Other Kind
                </p>(Specify Class)</th>
        </tr>
        <tr>
            <td width="285" valign="top">
                    1. For cash consideration:<br/>
                    (a) Number of shares ....................<br/>
                    (b) Nominal amount of each share.................... RM<br/>
                    (c) Amount (if any) paid on each share ....................RM<br/>
                    (d) Amount (if any) due and payable on each share .................... RM<br/>
                    (e) Amount of premium paid or payable on each share .................... RM<br/>
                    2. For consideration other than cash:<br/>
                    (a) Number of shares ....................<br/>
                    (b) Nominal amount of each share .................... RM<br/>
                    (c) Amount to be treated as paid on each of the shares so allotted .................... RM<br/>
                    (d) Amount of premium treated as paid up on each share .................... RM<br/>
                    (e) The consideration for which the<br/>
                    shares have been so allotted is as follows:</td>
            <td width="119" valign="top">-</td>
            <td width="104" valign="top">100
                </p>(Subscriber’s Share)
                </p>1.00
                </p>1.00</td>
            <td width="108" valign="top">
            </td>
        </tr>
    </tbody>
</table>
<p class="page-break"></p>
Company No. 
<TABLE BORDER=1>
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>

<p align="center">
    <strong>CERTIFICATE TO BE GIVEN BY ALL COMPANIES</strong>
</p>
<p>
    A certificate in the form set out hereunder shall be given by a director and a secretary of every company and annexed to this form.
</p>
<p align="center">
    <strong>CERTIFICATE</strong>
</p>
    We hereby certify, in relation to <strong> <u><b><?=$row['name']?></b></u> </strong> That:-<br/>

<ol type="a" style="padding-left: 15px;">
  <li>The share referred to in this return were allotted pursuant to Section 54(6) of the Companies Act, 1965.</li>
  <li>The shares so allotted do not exceed the authorized capital of the company which is RM <?=$row_app['capital']?> divided into <?=$row_app['numberofshares']?> share of RM<?=$row_app['priceperunit']?> each;</li>
  <li>* the allottees have agreed and have not withdrawn their agreement to take up the shares so allotted;</li>
  <li>* the shares were allotted to the allottees on applications received from them for shares in the company;</li>
  <li>* the shares were allotted as fully paid bonus shares to the existing shareholders;</li>
  <li>the total issued capital of the company now stands at 2 shares of RM <?=$row_app['priceperunit']?> each and the paid-up capital is RM 2.00; and</li>
  <li>* by virtue of section 54 (2), paragraph 3 of this form is not completed as:
    <ol type="i">
        <li>The company has more than five hundred members;</li>
        <li>The company keeps its principal share register at a place within twenty five kilometres of the office of the Registrar of Companies (7).........................;</li>
        <li>The company provides reasonable accommodation and facilities for persons to inspect and take copies of its list of members and its particulars of shares transferred;</li>
        <li>the shares referred to in this return were allotted for cash;</li>
        <li>the shares referred to in this return were allotted for a consideration other than cash and the number of persons to whom the shares have been allotted exceeds five hundred; and</li>
        <table style="margin-left: -50px;">
            <tbody>
                <tr><td style="vertical-align: top;">(a)</td><td>the number of shares allotted to citizens who are Malays and Natives is</td><td style="border-bottom:1px solid black;width:80px;text-align:center">100</td></tr>
                <tr><td style="vertical-align: top;">(b)</td><td>The number of shares allotted to citizens who are non-Malays and non-Natives is</td><td style="border-bottom:1px solid black;width:80px;text-align:center"></td></tr>
                <tr><td style="vertical-align: top;">(c)</td><td>The number of shares allotted to non-citizens is</td><td style="border-bottom:1px solid black;width:80px;text-align:center"></td></tr>
                <tr><td style="vertical-align: top;">(d)</td><td>The number of shares allotted to bodies corporate controlled by citizens who are Malays and Natives</td><td style="border-bottom:1px solid black;width:80px;text-align:center"></td></tr>
                <tr><td style="vertical-align: top;">(e)</td><td>The number of shares allotted to bodies corporate controlled by citizens who are non-Malays and non-Natives</td><td style="border-bottom:1px solid black;width:80px;text-align:center"></td></tr>
                <tr><td style="vertical-align: top;">(f)</td><td>The number of shares allotted to bodies corporate controlled by non-citizens</td><td style="border-bottom:1px solid black;width:80px;text-align:center"></td></tr>
                <tr><td colspan="2" style="text-align:right">TOTAL</td><td style="border-bottom:1px solid black;width:80px;text-align:center">100</td></tr>
            </tbody>
        </table>
    </ol>
  </li>
</ol>  
<br><br><br><br>
<?php
//Director info
$director_query = "SELECT * FROM v_personnel WHERE app_no = '$app_no' AND FIND_IN_SET('1',role) > 0"; 
$director_result = mysqli_query($con,$director_query) or die(mysqli_error($con));
$director_num   =   mysqli_num_rows($director_result);
$director_row   = mysqli_fetch_array($director_result);?>
<?php
//secretary information
$secretary_query = "SELECT * FROM v_personnel WHERE id = (SELECT secretary FROM v_app WHERE app_no='$app_no')"; 
// echo $secretary_query ;
$secretary_result = mysqli_query($con,$secretary_query) or die(mysqli_error($con));
$secretary_num  =   mysqli_num_rows($secretary_result);
$secretary_row = mysqli_fetch_array($secretary_result)?> 
<table style="font-size:12px">
    <tr><td style="border-bottom:1px solid black;width:300px"></td><td style="width:150px"></td><td style="border-bottom:1px solid black;width:300px">   </td></tr>
    <tr><td><?=$director_row['name']?> <br>Director</td><td style="width:150px"></td><td><?=$secretary_row['name']?> <br>(<?=$secretary_row['license_no']?>)<br>Company Secretary  </td></tr>

</table>

</p>
<br clear="ALL"/>
<p>
    
</p>
<p>
    
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
 </div>