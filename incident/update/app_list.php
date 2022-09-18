<?php
session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: index.html' ) ;
}
include '../DB.php';

$page = 0;
$limit = 10;
$proj_list = str_REPLACE(',','\',\'',$_SESSION['project']);
if(isset($_GET['page'])){
  $page = $_GET['page'];
  $start = ($page - 1) * $limit; 
}else{    $start = 0;     }

if ($page == 0) $page = 1;

$sqlquery = "SELECT * FROM casesaddr ";
   $fltrsql = "  ";
   $fltr2sql= "";
   if(isset($_GET['fltr2']) && ($_GET['fltr2'] !="")){
    $fltr2sql=" and ".htmlspecialchars(urldecode($_GET['fltr2']));
    $fltr2sql = str_replace("^", "%", $fltr2sql);    
   }
   $srchsql = " ";
   if(isset($_GET['srch'])){
      $srch  = htmlspecialchars(urldecode($_GET['srch']));
      if ($srch == "y"){
         $srcht =  htmlspecialchars(urldecode($_GET['srcht']));
         if($srcht != ""){$srchsql = " ";}
      }
   }
   $srt="";
 if(isset($_GET['srt'])){
  $srt = htmlspecialchars(urldecode($_GET['srt']));
 }
   if($srt =="")$srt = "open_date desc";
   $srtsql = " ORDER BY ";
   $srtsql = $srtsql .$srt."  LIMIT $start, $limit ";
   $sqlquery = $sqlquery.$fltrsql.$fltr2sql.$srchsql.$srtsql;

   $query = "SELECT COUNT(*) as num FROM casesaddr ";
   $query = $query .$fltrsql.$fltr2sql.$srchsql;


// echo "sql = " .$sqlquery;


$result =   mysqli_query($con,$sqlquery) or die("sql = ". $sqlquery);          //query

$total_pages = mysqli_fetch_array(mysqli_query($con,$query));
$total_pages = $total_pages['num'];


$num    =   mysqli_num_rows($result);
$maxpage= ceil($total_pages/$limit);        

$i=0;
?>
                  <blockquote >
                      <p>Showing page <?=$page?> / <?=$maxpage?> of <?=$total_pages?> records  found</p>
                  </blockquote> 
                  <div style="float:right;margin-top:-25px;">
<!--                     <button style=""  id="btn-export-top" class="btn letter btn-xs btn-default"><i class="icon-print"></i> export</button> 
                    <button style=""  id="btn-printPage-top" class="btn letter btn-xs btn-default"><i class="icon-print"></i> Print</button> 
 -->                    <button id="first-top" class="btn letter btn-xs btn-default"><i class="icon-step-backward"></i> </button>
                    <button id="prev-top" class="btn letter btn-xs btn-default"><i class=" icon-angle-left "></i> </button>
                    <button id="next-top" class="btn letter btn-xs btn-default">  <i class="icon-angle-right"></i></button>
                    <button id="last-top"class="btn letter btn-xs btn-default">  <i class="icon-step-forward "></i></button>
                  </div>
                  <table id="tbl_application" class="table table-hover  tablesorter">
                    <thead>
                      <tr>
                        <th style="width: 50px;">No <i class="fa fa-sort"></i></th>
                        <th>Incident ID <i class="fa fa-sort"></i></th>
                        <th>Contact Person <i class="fa fa-sort"></i></th>
                        <th>Contact Number <i class="fa fa-sort"></i></th>
                        <th>Problem Title <i class="fa fa-sort"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row = mysqli_fetch_array($result)){
                        $i++;
                        echo      "<tr data=". $row['case_id']."><td>".((($page-1) * 10 ) + $i)."</td>";?>
                        <td><?=$row['case_id']?></td>                        
                        <td><?=$row['caller']?></td>
                        <td><?=$row['contact']?></td>
                        <td><?=$row['title']?></td>


                        </tr><?php
                    }
                    ?>                      

                    </tbody>
                  </table>
 <blockquote  >
  <p>Showing page <?=$page?> / <?=$maxpage?> of <?=$total_pages?> records  found</p>
</blockquote> 

<div style="float:right;margin-top:-25px;">
<!-- <button style=""  id="btn-export-btm" class="btn letter btn-xs btn-default"><i class="icon-print"></i> export</button> 
<button style=""  id="btn-printPage" class="btn letter btn-xs btn-default"><i class="icon-print"></i> Print</button>  -->
  <button id="first-btm" class="btn letter btn-xs btn-default"><i class="icon-step-backward"></i> </button>
  <button id="prev-btm" class="btn letter btn-xs btn-default"><i class=" icon-angle-left "></i> </button>
  <button id="next-btm" class="btn letter btn-xs btn-default">  <i class="icon-angle-right"></i></button>
  <button id="last-btm"class="btn letter btn-xs btn-default">  <i class="icon-step-forward "></i></button>       
</div>
<input type="hidden" id="rpt_max" value="<?=$maxpage?>">
<script type="text/javascript">
    $('#tbl_application tbody tr').click(function(){
      window.location.replace("view.php?app_no="+$(this).attr('data'));
    })
  $( "#prev-top" ).click(function() {
      var page = (parseInt($("#rpt_page").val())-1);
      if (page >= 1)  {
      $("#rpt_page").val(page);
          var strLoader = genLoader('fltr2',$("#fltr2").val(),'app_list.php');
      $('#div_app_list').load(strLoader+'&page='+page, function() {});
      }
  });
  $( "#next-top" ).click(function() {
      var page = (parseInt($("#rpt_page").val())+1);
      var max = parseInt($("#rpt_max").val());
      if (page <= max)  {
          $("#rpt_page").val(page);
          // alert(page)
          // alert($("#fltr2").val());
          var strLoader = genLoader('fltr2',$("#fltr2").val(),'app_list.php');
        $('#div_app_list').load(strLoader+'&page='+page, function() {});
      }
    });
  $( "#first-top" ).click(function() {
        $("#rpt_page").val('1');
            var strLoader = genLoader('fltr2',$("#fltr2").val(),'app_list.php');
        $('#div_app_list').load(strLoader+'&page=1', function() {});
    });
  $( "#last-top" ).click(function() {
        var max = parseInt($("#rpt_max").val());
        $("#rpt_page").val(max);
            var strLoader = genLoader('fltr2',$("#fltr2").val(),'app_list.php');
        $('#div_app_list').load(strLoader+'&page='+max, function() {});
      });


  $( "#prev-btm" ).click(function() {
      var page = (parseInt($("#rpt_page").val())-1);
      if (page >= 1)  {
      $("#rpt_page").val(page);
          var strLoader = genLoader('fltr2',$("#fltr2").val(),'app_list.php');
      $('#div_app_list').load(strLoader+'&page='+page, function() {});
      }
  });
  $( "#next-btm" ).click(function() {
      var page = (parseInt($("#rpt_page").val())+1);
      var max = parseInt($("#rpt_max").val());
      if (page <= max)  {
          $("#rpt_page").val(page);
            var strLoader = genLoader('fltr2',$("#fltr2").val(),'app_list.php');
        $('#div_app_list').load(strLoader+'&page='+page, function() {});
      }
    });
  $( "#first-btm" ).click(function() {
        $("#rpt_page").val('1');
            var strLoader = genLoader('fltr2',$("#fltr2").val(),'app_list.php');
        $('#div_app_list').load(strLoader+'&page=1', function() {});
    });
  $( "#last-btm" ).click(function() {
        var max = parseInt($("#rpt_max").val());
        $("#rpt_page").val(max);
            var strLoader = genLoader('fltr2',$("#fltr2").val(),'app_list.php');
        $('#div_app_list').load(strLoader+'&page='+max, function() {});
      });
  $('#btn-export-top').click(function(){
      var strLoader=genLoader('fltr2',$("#fltr2").val(),'rpt-excel.php');
      window.location.replace(strLoader);
  })
  $('#btn-export-btm').click(function(){
      var strLoader=genLoader('fltr2',$("#fltr2").val(),'rpt-excel.php');
      window.location.replace(strLoader);
  })
  $('#btn-printPage').click(function(){
      var strLoader=genLoader('fltr2',$("#fltr2").val(),'print_app_list.php');
        $.ajax({
        type: "GET",
        url:    strLoader+'&code='+$('#code').val() ,
        async:   false,
           success: function(result) {
            $("#mydiv").html(result);              print_rpt(result);
           }


      }); 

  })
  $('#btn-printPage-top').click(function(){
      var strLoader=genLoader('fltr2',$("#fltr2").val(),'print_app_list.php');
        $.ajax({
        type: "GET",
        url:    strLoader+'&code='+$('#code').val() ,
        async:   false,
           success: function(result) {
            $("#mydiv").html(result);              print_rpt(result);
           }


      }); 

  })
function print_rpt(result){
    var printContents =           $("#mydiv").clone();
      $("#mydiv").html("");    
    var printW = window.open("", "popup","width=1000,height=600,scrollbars=yes,resizable=yes," +  
        "toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0");

    var doc = printW.document;
    doc.open();
    // $(printContents).find("#tdAction").remove();
    doc.write('<html><head><title>Report</title>');
    doc.write('   <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="" />');
    doc.write('  ');
    doc.write('<style>@media screen {body{font-size:10px}} @media print { body{font-size:10px} table { page-break-after:auto }  tr    { page-break-inside:avoid; page-break-after:auto }  td    { page-break-inside:avoid; page-break-after:auto }  thead { display:table-header-group }  tfoot { display:table-footer-group }}</style>');
    doc.write('</head><body >');
    doc.write($(printContents).html());
    doc.close();  
    $(printW).ready(function()    {
        printW.print();
    });

}

</script>