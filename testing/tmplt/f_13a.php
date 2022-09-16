<link href="../css/bootstrap.css" rel="stylesheet">
<!-- Add custom CSS here -->
<link href="../css/sb-admin.css" rel="stylesheet">
<!-- JavaScript -->

<script src="../js/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>    
<script src="../js/bootstrap.js"></script>
<?
if(isset($_GET['app_no'])){
	include '../DB.php';
	$app_no		= 	htmlspecialchars(trim($_GET['app_no']));

}
?>
<HTML>
	<STYLE TYPE="text/css">
	<!--
/*		@page { margin: .75in }
		P { margin-bottom: 0.08in; direction: ltr; color: #000000; widows: 2; orphans: 2 }
		P.western { so-language: en-US }
*/	-->
	@media all {
	.page-break	{ display: none; }
	}

	@media print {
		body {font-size: 12px;font-family: Times New Roman;}
		table {font-size:  11px;font-family: Times New Roman;}
		.page-break	{ display: block; page-break-before: always; }
	}
	</STYLE>
<HEAD>
<TITLE>FORM 13A. Request For Availability Of Name. (COMPANIES REGULATIONS, 1966 - P.U. 173/66)</TITLE></HEAD>
<BODY TEXT="000000" BGCOLOR="FFFFFF">
<DIV ALIGN=center>
FORM 13A<BR>
Companies Act 1965<BR>
(Section 22 (6))<BR><BR><BR>

REQUEST FOR AVAILABILITY OF NAME</DIV><BR>
Our Ref .................................
<UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL><UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL></UL>
<DIV ALIGN=right style="margin-top:-23px">Reference No. (Leave Blank) .............................<BR><BR><BR>
</DIV>
<DIV ALIGN=center>SECTION A: TO BE COMPLETED BY APPLICANT 
IN BLOCK LETTERS</DIV>
<BR>
<table >
	<tr style="vertical-align:top"><td>PROPOSED NAME </td><td>
<ul>
<?php

			$query = "SELECT name, descr, if(status = '0','Pending For Approval',if(status='1','Approved',status)) status FROM com_names where app_no='$app_no'"; 
			$result = mysqli_query($con,$query) or die(mysqli_error($con));
			$num	=	mysqli_num_rows($result);
			$i = 1;
			if($num>0){?>	<?
			while($row = mysqli_fetch_array($result)){?>		
	          <li style=" list-style-type: none"><u><?=$row['name']?></u> (MAXIMUM 50 CHARACTERS)</li><?
	            $i++;
	        }
	    }?>
</ul></td></tr>	
</table>
<BR>
<TABLE WIDTH="100%" BORDER=1  >
<TR VALIGN=top><TD WIDTH="50%"><UL>PURPOSE : <U>N</U> <BR>
N-NEW INCORPORATION<BR>
F-REGISTRATION OF<BR>
FOREIGN COMPANY<BR>
C-CHANGE OF NAME<BR>
<BR>
<?

	$sqlquery 	= 	"SELECT * FROM v_applications where app_no = '$app_no'";
	$result		=	mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
	$row		=	mysqli_fetch_array( $result );
?>
NAME OF APPLICANT:<BR><?=$row['name']?>
<BR>
ADDRESS OF APPLICANT:<BR><?=$row['addr_1']?>
<BR><?=$row['addr_2']?><BR><?=$row['postcode']?> <?=$row['city']?><BR><?=$row['state']?><BR><BR>
TELEPHONE No:<BR><?=$row['phone_office']?><?=$row['phone_hp']?>
<BR>
REQUEST DATE: <?=$row['app_date']?> </UL></TD><TD WIDTH="50%"><UL>TYPE : <U>S</U> <BR>
S-LIMITED BY SHARES<BR>
G-LIMITED BY GUARANTEE<BR>
<BR>
U-UNLIMITED COMPANY<BR>
<BR>
<BR>
<BR>
<BR>
<DIV ALIGN=center>..................................................... <BR>
<I>Signature of Applicant</I></DIV></UL></TD></TR>
</TABLE>
<BR>
&#8224; If proposed name requires further clarifications, the applicant is required to fill up Section C.<UL><UL><UL><UL><UL><UL><UL><UL>
</UL></UL></UL></UL></UL></UL></UL></UL><DIV ALIGN=center>SECTION B: FOR THE REGISTRY'S USE ONLY</DIV><BR>

<TABLE WIDTH="100%" BORDER=1>
<TR VALIGN=top><TD WIDTH="50%"><UL><I>SEARCH RESULT</I><BR>
AVAILABIILITY:.... /..... /.....<BR>
<BR>
A-AVAILABLE <BR>
R-REJECTED <BR>
S-SUBJECT TO QUERY <BR>
<BR>
<BR>
REMARKS:</UL></TD><TD WIDTH="50%"><UL>DATE PROCESSED:...../....../......<BR>
PROCESSED BY: ........................... <BR>
DATE ENTERED:..... /..... /...... <BR>
ENTERED BY ......................................</UL></TD></TR>
</TABLE>
<BR>
<div class="page-break"></div>

<DIV ALIGN=center>SECTION C: TO BE COMPLETED BY APPLICANT</DIV>
<TABLE BORDER=1>
<TR VALIGN=top><TD WIDTH="100%"><DIV ALIGN=center><I>CLARIFICATION</I></DIV><BR>
1. Single letters included in the name stand for:<BR>
<BR>
2. If the proposed name is not in Bahasa Malaysia or English, please clarify:<BR>
<BR>
3. If the proposed name contains a proper name, state whether it is the name of a director of the company or the proposed company:<BR>
<BR>
4. If proposed name is similar to that of a related or associated corporation &#8224;, state whether written consent has been obtained from the said corporation (please attach consent):<BR>
<BR>
5. If the proposed name is a trade mark, state whether written consent has been obtained from the owner (please attach consent):<BR>
<BR>
6. If the proposed name is to be used for change of name of an existing corporation, state the following:<BR>
<BR>
Existing name:  ......................................<BR>
<BR>
Company: ............................................................................................<BR>
<BR>
7. The nature of the business carried on or to be carried on by the company .........<BR>
<BR>
<I>(Am. P.U.(A) 80 /1993:s.5</I>)<BR>
<BR>
8. Other comments:<BR>
<BR>
<I>(Am. P.U.(A) 80 /1993:s.5</I>)</TD></TR>
</TABLE>
<BR>
<BR>
Notes:<BR>
<BR>
&#8224; For definition of &quot;related corporation&quot;and &quot;associated corporation&quot;,  please see<BR>
Companies Act 1965, and International Accounting Standards respectively.<BR>
		  <BR>
 Use additional sheets if necessary.<BR>
</HTML>
