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
    .table-bordered-black th{border:1px solid black;padding:10px;}

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

Company No. 
<TABLE BORDER=1>
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>

<p align="center">
    THE COMPANY ACT,1965
</p>
<p align="center">
    COMPANY LIMITED BY SHARES
</p>
<p align="center">
    MEMORANDUM OF ASSOCIATION
</p>
<p align="center">
    OF
</p>
<p align="center">
<?php
//Company Name
$query = "SELECT name, descr, if(status = 'false','Pending For Approval',if(status='true','Approved',status)) status FROM com_names where app_no='$app_no' and status = 'true'"; 
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$num    =   mysqli_num_rows($result);
$row = mysqli_fetch_array($result)
?>
    <strong> <u><b><?=$row['name']?></b></u> </strong>
</p>
<p align="center">
    <strong></strong>
</p>
<br clear="ALL"/>
<ol type="I">
<li>The name of the company is <strong><?=$row['name']?></strong></li>
<li>The registered office of the company will be situated in Malaysia.</li>
<li>The objects for which the company is established are:
    <ol type="1">
        <li>To carry on all or any of the traders and businesses of farmers, graziers, breeders of and dealers in livestock, market gardens, arboriculturists,
    horticulturists, and dairymen and any other trade or business in connection with arboriculture, agriculture, or horticulture .</li>
        <li>To carry on the business of planter, farmers, and cultivators of and dealers in rubber, oil palm, coconut, gutcapercha, jelutong, latex, bearing plants,
    rice, wheat, oats, cereals and grains of all kids, sugar tea, bananas, coffee, cocoa, spices, pepper, cinchano , cinnamon tobacco Gambier, oil palms,
    cotton, flax, fruit trees, potatoes, root crops, mulberry and other trees for the production of silk, and all kinds of trees and plants.</li>
        <li> To carry on business as timber merchants, lumber merchants, saw-mill proprietors and timber growers, and to buy, sell, grow, prepare for market
    manipulate, import, export, and deal in timber and wood of all kinds and to manufacture and deal in articles of all kinds and to manufacture of which
    timber or wood is used, and to carry on business as ship owners and carriers by land and sea, and so far as may deem expedient, the business of general
    merchants and to carry on any other businesses which may seem to the company capable of being conveniently carried on in connection with any of the above,
    or calculated directly or indirectly to render profitable or enhance the value of the company’s property or rights for the time being.</li>
    </ol>
</li>
<li>The power of a company in the third schedule (section 19) to the act shall apply. And it is hereby declared that the word ‘company’ in this clause
    except where used in reference to this company, shall be deemed to include any partnership or other body of person whether incorporated or unincorporated
    and whether domiciled in Malaysia or elsewhere, and further that the objects specified in each paragraph of his clause shall be regarded as independent
    objects and accordingly shall,except where otherwise expressed in any paragraph be in no wise limited or restricted by reference to or inference from the
    terms of any other paragraph or the name of the company but may be carried out in as full and ample a manner and construed just as wide sense as if the
    said paragraph defined the object of a separated distinct and independent company.</li>
<li>The liability of the members is limited</li>    
<li>VI. The capital of the company is RM <?=$row_app['capital']?> Malaysian currency divided into <?=$row_app['numberofshares']?> shares of RM <?=$row_app['priceperunit']?>/each. The shares in the original or any increased
    capital may be divided into several classes and there may be attached there to respectively any preferential,deferred or other rights,
    privileges,conditions or restrictions as to dividends,capital,voting or otherwise.</li>
<li>VII. Subjects always to the respective rights,terms and conditions mentioned in clause 6 hereof the company shall have power to increase or reduce the
    capital to consolidate or sub-divide that shares of larger or smaller amounts and to issue all or any part of the original or any additional capital as
    fully or partly paid shares and with any special or preferential rights or privileges, or subject to any special designation and also from time to time to
    alter, modify, commute, abrogate, or deal with any such rights, privileges, terms, conditions, or designation in accordance with the regulations for the
    time being of the company.</li>
</ol>


<p class="page-break"></p>
Company No. 
<TABLE BORDER=1>
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>
<p>
    We, the several persons whose names and addresses are subscribed hereto, are desirous of being formed into a company in pursuance of this memorandum of
    associations, and we respective names.
</p>
<TABLE class="table-bordered-black" WIDTH=100%>
<TR VALIGN=top><TH >Names, addresses and descriptions of subscribers </TH><th>Number of shares taken by each subscriber.</th></TR>
<?php

            $personnel_query = "SELECT * FROM v_personnel WHERE FIND_IN_SET('2',role) > 0 and app_no='$app_no'"; 
            $personnel_result = mysqli_query($con,$personnel_query) or die(mysqli_error($con));
            $personnel_num  =   mysqli_num_rows($personnel_result);
            $i = 1;
            if($personnel_num>0){?> <?
            while($personnel_row = mysqli_fetch_array($personnel_result)){?>     
                <TR VALIGN=top>
                    <TD >
                        <p><?=$personnel_row['name']?></p>
                        <p>
                            <?=$personnel_row['addr_1']?> <br>
                            <?=$personnel_row['addr_2']?><br>
                            <?=$personnel_row['postcode']?> <?=$personnel_row['city']?><br>
                            <?=$personnel_row['state']?><br>
                            <?=$personnel_row['ic']?><br>
                            <?=$personnel_row['dob']?>

                        </p>
                    </TD>
                    <td>
                        <p><?=$personnel_row['share_percentage']?> %</p>
                        <p><?=$personnel_row['share_unit']?> Unit</p>
                    </td>
                </TR>
              
              <?
                $i++;
            }
        }?>

</TABLE>

<p style="margin-top: 50px">
    Dated this:
</p>
<p>
    Witness to the above signatures:
</p>
<p>
<?php
//secretary information
$secretary_query = "SELECT * FROM v_personnel WHERE id = (SELECT secretary FROM v_app WHERE app_no='$app_no')"; 
// echo $secretary_query ;
$secretary_result = mysqli_query($con,$secretary_query) or die(mysqli_error($con));
$secretary_num  =   mysqli_num_rows($secretary_result);
$secretary_row = mysqli_fetch_array($secretary_result)?>     
 
<?=$secretary_row['name']?>
</p>
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

<p class="page-break"></p>
Company No. 
<TABLE BORDER=1>
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>
<br clear="ALL"/>
<p align="center">
    <strong>THE COMPANIES ACT, 1965</strong>
</p>
<p align="center">
    <strong>PRIVATE COMPANY LIMITED BY SHARES</strong>
</p>
<p align="center">
    <strong>ARTICLES OF ASSOCIATION</strong>
</p>
<p align="center">
    <strong>OF</strong>
</p>
<p align="center">
    <strong><u><b><?=$row['name']?></b></u></strong>
</p>
<p align="center">
    <strong>TABLE A</strong>
</p>
<ol type="1">
    <li>The regulations in Table A in the fourth schedule to the act shall apply expect so far for those as specified or contained in these articles.</li>
    <p align="center">
        <strong>PRIVATE COMPANY</strong>
    </p>
    <li>The company is a private company and accordingly:-
        <ol type="a">
            <li>The right to transfer shares is restricted in a manner herein after prescribed:</li>
            <li>Limits to not more than fifty the number of its members (counting joint holders of shares as one person and not counting any person in the employment of
    the company or of its subsidiary or any person who while previously was and thereafter has continued to be a member of the company)</li>
            <li>Any invitation to the public to subscribe for any shares in to subscribe for any shares in or debentures of the company is prohibited.</li>
            <li>Any invitation to the public to deposit money with the company for fixed periods or payable at call, whether bearing or not bearing interest, is
    prohibited.</li>
        </ol>
    </li>
    <p align="center">
        <strong>DIRECTORS</strong>
    </p>    
    <?php
    //Director info
    $director_query = "SELECT * FROM v_personnel WHERE app_no = '$app_no' AND FIND_IN_SET('1',role) > 0"; 
    $director_result = mysqli_query($con,$director_query) or die(mysqli_error($con));
    $director_num   =   mysqli_num_rows($director_result);
    $director_row = mysqli_fetch_array($director_result)?>       
    <li>The directors shall be <strong>
        <?
        $i=1;
        $total=$director_num-1;
        while($i<=$director_num){

            echo $director_row['name'];
            if($i<$total){echo", ";}
            if($i==$total){echo" and ";}
            $i++;

        }
        ?></strong>
    </li>
    <li>Until and unless otherwise determined as aforesaid the number of director shall be not less than two and not more than nine.</li>
    <li>A resolution in writing signed by a majority of the directors for the time being or their alternates not being less than two directors shall be as if it
    had been passed by a meeting of the directors duly called and constituted.</li>
    <li>The first secretary shall be <strong><?=$secretary_row['name']?> (<?=$secretary_row['license_no']?>)</strong></li>
    <li>The directors may, in their absolute discretion and without assigning any reason therefore, decline register the transfer of any shares ,whether or not
    it is a fully paid share<strong>.</strong></li>

</ol>


<p class="page-break"></p>
Company No. 
<TABLE BORDER=1>
<TR VALIGN=top><TD style="padding:5px"><?=$row_app['com_ref_no']?></TD></TR>
</TABLE>
<strong></strong>
<p>
    <strong></strong>
</p>
<br clear="ALL"/>
<p>
    We, the several persons whose names and addresses are subscribed here under being subscribers hereby agree to the foregoing Articles of Association.
</p>
<TABLE class="table-bordered-black" WIDTH=100%>
<TR VALIGN=top><TH >Names, addresses and descriptions of subscribers </TH></TR>
<?php

            $personnel_query = "SELECT * FROM v_personnel WHERE FIND_IN_SET('2',role) > 0 and app_no='$app_no'"; 
            $personnel_result = mysqli_query($con,$personnel_query) or die(mysqli_error($con));
            $personnel_num  =   mysqli_num_rows($personnel_result);
            $i = 1;
            if($personnel_num>0){?> <?
            while($personnel_row = mysqli_fetch_array($personnel_result)){?>     
                <TR VALIGN=top>
                    <TD >
                        <?=$personnel_row['name']?>
                        
                        <p><?=$personnel_row['addr_1']?> </p>
                        <p><?=$personnel_row['addr_2']?></p>
                        <p><?=$personnel_row['postcode']?> <?=$personnel_row['city']?></p>
                        <p><?=$personnel_row['state']?></p>
                        
                        <p><?=$personnel_row['ic']?></p>
                        <p><?=$personnel_row['dob']?></p>
                        <p><?=$personnel_row['designation']?></p>
                    </TD>

                </TR>
              
              <?
                $i++;
            }
        }?>

</TABLE>
<p style="margin-top:50px">
    Dated this:
</p>
<p>
    Witness to the above signatures:
</p>
<p>
    <?=$secretary_row['name']?> (<?=$secretary_row['license_no']?>
)
</p>
<?=$comsec_row['com_name']?><br>
<?=$comsec_row['addr_1']?><br>
<?=$comsec_row['addr_2']?><br>
<?=$comsec_row['postcode']?> <?=$comsec_row['city']?><br>
<?=$comsec_row['negeri']?><br>
Tel:09-2963620<br>
Fax:09-2964620<br>
</div>