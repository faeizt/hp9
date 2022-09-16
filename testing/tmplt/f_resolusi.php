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
Company No. 
<TABLE BORDER=1>
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>
<br clear="ALL"/>
<p align="center">
<?php
//Company Name
$query = "SELECT name, descr, if(status = 'false','Pending For Approval',if(status='true','Approved',status)) status FROM com_names where app_no='$app_no' and status = 'true'"; 
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$num    =   mysqli_num_rows($result);
$row = mysqli_fetch_array($result)
?>
    <strong> <u><b><?=$row['name']?></b></u> </strong>
    <br>
    (Incorporated in Malaysia)
</p>
<p>
    DIRECTORS’ RESOLUTION IN WRITING PURSUANT TO ARTICLE 90 OF THE ARTICLES OF ASSOCIATION OF THE COMPANY PASSED ON THE 29<sup>TH </sup>DAY OF NOVEMBER, 2012.
</p>
<p>
    <u>BANKING ACCOUNT</u>
</p>
<p>
IT WAS RESOLVED THAT the <?=$row_app['bank']?> branch is hereby authorized to open an account in the name of    <strong><?=$row['name']?></strong> and that all formal resolution which the said bank might prescribe for opening account be adopted as though
    set out herein:-
</p>
<?php
//Director info
$director_query = "SELECT * FROM v_personnel WHERE app_no = '$app_no' AND FIND_IN_SET('1',role) > 0"; 
$director_result = mysqli_query($con,$director_query) or die(mysqli_error($con));
$director_num   =   mysqli_num_rows($director_result);
$director_row   = mysqli_fetch_array($director_result);?>
<ol type="i">
    <li>That the Bank be instructed to honour all cheques, promissory notes and other order drawn by and all bills accepted on behalf of the Company, whether
    the Company’s Bank Account be in credit or otherwise provided, they signed by the following signatory:-
        <ol>
            <li> <?=$director_row['name']?></li>
            <li>I/C No.: <?=$director_row['ic']?></li>
        </ol>
    </li>
    <li>That all cheques,bills of exchange, promissory notes and other documents requiring endorsement for the purpose of paying to the said Banking Account to
    be endorsed by the director on the Company’s behalf</li>
    <li>That a certified copy of these Resolution be furnished to the Bank and that the said Bank of a copy of Resolution to be passed by the Company
    rescinding the same.</li>
</ol>

<p style="text-align:center">
    SIGNATURES OF DIRECTORS APPROVING THE ABOVE:
</p>
<br clear="ALL"/>
<br clear="ALL"/>
<div style="width:100%">
<?php //Director info
$director_query = "SELECT * FROM v_personnel WHERE app_no = '$app_no' AND FIND_IN_SET('1',role) > 0"; 
$director_result = mysqli_query($con,$director_query) or die(mysqli_error($con));
$director_num   =   mysqli_num_rows($director_result);
while($director_row = mysqli_fetch_array($director_result)){?>
    <div style="margin-left:50px;margin-right:50px;float:left;width:30%;text-align:center;margin-bottom:50px">
        <div style="width:100%;border-bottom:1px solid black"></div>
        <div><?=$director_row['name']?></div>
    </div>

<?}?>     
</div>



<br/>
<p style="clear:both">
    Dated:
</p>
</div>