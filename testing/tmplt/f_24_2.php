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
Company No. 
<TABLE BORDER=1 >
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE><p>
    <a name="_GoBack"></a>
</p>
<br clear="ALL"/>
<p>
    3. Particulars of allottees of the shares so allotted and the number and classes of shares allotted to them are as follows:-
</p>
<TABLE class="table-bordered-black" WIDTH=100%>
    <TR VALIGN=top>
        <TH rowspan="3" valign="top">Full Name & Address </TH>
        <th rowspan="3" valign="top">Nationality<br/>Race</th>
        <th rowspan="3" valign="top">I/C No. / Passport No</th>
        <th colspan="6" valign="top">Number of Shares Allotted</th>
    </TR>
    <tr>
        <th width="132" colspan="2" valign="top">Preference            </th>
        <th width="161" colspan="2" valign="top">Ordinary            </th>
        <th width="133" colspan="2" valign="top">Other Kinds            </th>
    </tr>
    <tr>
        <th width="47" valign="top">Cash            </th>
        <th width="85" valign="top">Otherwise            </th>
        <th width="76" valign="top">Cash            </th>
        <th width="85" valign="top">Otherwise            </th>
        <th width="47" valign="top">Cash            </th>
        <th width="85" valign="top">Otherwise            </th>
    </tr>

<?php

            $personnel_query = "SELECT * FROM v_personnel WHERE FIND_IN_SET('2',role) > 0 and app_no='$app_no'"; 
            $personnel_result = mysqli_query($con,$personnel_query) or die(mysqli_error($con));
            $personnel_num  =   mysqli_num_rows($personnel_result);
            $i = 1;
            $totalshare  = "";
            if($personnel_num>0){?> <?
            while($personnel_row = mysqli_fetch_array($personnel_result)){?>     
                <TR VALIGN=top>
                    <TD >
                    <p><?=$personnel_row['name']?></p>
                    <p>
                        <?=$personnel_row['addr_1']?><br/>
                        <?=$personnel_row['addr_2']?><br/>
                        <?=$personnel_row['postcode']?> <?=$personnel_row['city']?><br/>
                        <?=$personnel_row['state']?>
                    </p>                        
                    </TD>
                    <td><p style="text-align:center"><?=$personnel_row['nationality']?><br/><?=$personnel_row['race']?></p></td>
                    <td><p><?=$personnel_row['ic']?></p></td>
                    <td></td>
                    <td></td>
                    <td><p><?=$personnel_row['share_unit']?> </p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </TR>
              
              <?
                $totalshare = $totalshare + $personnel_row['share_unit'];
                $i++;
            }
        }?>
        <tr>
            <td colspan="3">Total shares</td>
            <td>NIL</td>
            <td>NIL</td>
            <td><?=$totalshare?></td>
            <td>NIL</td>
            <td>NIL</td>
            <td>NIL</td>
        </tr>
</TABLE>


<p>
    Dated this:
</p>
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
<br clear="ALL"/>
<table style="font-size:12px; width:100%">
    <tr><td style="border-bottom:1px solid black;width:40%"></td><td style="width:20%"></td><td style="border-bottom:1px solid black;width:40%">   </td></tr>
    <tr><td><?=$director_row['name']?><br>Director</td><td style="width:150px"></td><td><?=$secretary_row['name']?> <br>(<?=$secretary_row['license_no']?>)<br>Company Secretary  </td></tr>

</table>
