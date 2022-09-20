<?php
session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: index.html' ) ;
}
include '../DB.php';

$access_query     =   "SELECT * FROM sys_user_ac WHERE user_id = ".$_SESSION['user_id'] ;      // echo $sqlquery;
$result           =   mysqli_query($con,$access_query) or die("sql= ". $access_query);          //query

$result_array = array();

while($row = mysqli_fetch_array($result)){
$result_array[] = $row;
}

$project="";
$PAC  = 0;

foreach ($result_array as $results) {
  $PAC = $results['access'];
  if ($PAC & 8192) {
    $project = $project. "'" .$results['project_code'] . "',";
  }
}
$project = substr($project,0,-1);

$page = 0;
$limit = 10;
$proj_list = str_REPLACE(',','\',\'',$_SESSION['project']);
if(isset($_POST['page'])){
  $page = $_POST['page'];
  $start = ($page - 1) * $limit; 
}else{    $start = 0;     }

if ($page == 0) $page = 1;
if ($project != "") {
  $sqlquery = "SELECT * FROM v_incident WHERE project_code in (".$project.") ";  
}else{
  $sqlquery = "SELECT * FROM v_incident  ";  
}
   $fltrsql = "";
   if(isset($_POST['fltr']) && ($_POST['fltr'] !="")){
    $fltrsql    = htmlspecialchars(urldecode($_POST['fltr']));
    $fltrsql    = str_replace("^", "%", $fltrsql);    
    $fltrsql    = str_replace("\\", "", $fltrsql);


   }
  if(isset($_POST['begin']) && ($_POST['begin'] !="")){
    $date_type  = htmlspecialchars(urldecode($_POST['date_type']));
    $begin      = htmlspecialchars(urldecode($_POST['begin']));
    $end        = htmlspecialchars(urldecode($_POST['end']));
    if ($fltrsql =="") {
        $fltrsql = " and ". $fltrsql;
      
    }
    else{
      if ($project =="") {
        $fltrsql = " where ". $fltrsql;
      }else{
        $fltrsql = " and ". $fltrsql;
      }
      $fltrsql = $fltrsql . " AND ";
    }
    $fltrsql    = $fltrsql . " $date_type BETWEEN (STR_TO_DATE('$begin', '%Y-%m-%d')) AND DATE_ADD((STR_TO_DATE('$end', '%Y-%m-%d')), INTERVAL 1 DAY) ";

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
   $sqlquery = $sqlquery.$fltrsql.$srchsql.$srtsql;

   $query = "SELECT COUNT(*) as num FROM v_incident WHERE project_code in (".$project.") ";
   $query = $query .$fltrsql.$srchsql;

 //echo "sql = " .$sqlquery;


 $result =   mysqli_query($con,$sqlquery) or die("sql = ". $sqlquery);          //query
 $result2 =   mysqli_query($con,$query) or die("sql = ". $query);          //query
 $total_pages = mysqli_fetch_array($result2);
 $total_pages = $total_pages['num'];
 
 
 $num    =   mysqli_num_rows($result);
$maxpage= ceil($total_pages/$limit);        

$i=0;
?>
          <blockquote>
          <p style="padding:5px">Showing page <?=$page?> / <?=$maxpage?> of <?=$total_pages?> records  found</p>
          </blockquote>   
          <div style="float:right;margin-top:-35px;">    
          <div class="btn-group">
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cog"></i>
              </button>
              <ul class="dropdown-menu">
                <li id="compact_view_top"><a href="#">Compact View</a></li>
                <li id="details_view_top"><a href="#">Details View</a></li>
              </ul>
            </div>
            <button id="first-top" class="btn  btn-small btn-default"><i class="icon-step-backward"></i> </button>
            <button id="prev-top" class="btn  btn-small btn-default"><i class=" icon-angle-left "></i> </button>
            <button id="next-top" class="btn  btn-small btn-default">   <i class="icon-angle-right"></i> </button>
            <button id="last-top" class="btn  btn-small btn-default">  <i class="icon-step-forward "></i> </button>
          </div> 
          </div>       
                      <!-- <tr style="border-bottom:1px solid #ddd">
                            <td style="width:50px"><a class="pull-left" href="#"><img src="holder.js/70x70/social/text:01" style="border:5px solid #ddd" class="img-circle"></a></td>
                            <td style="padding:15px">          
                            <div style="margin-right: 100px;">
                              <strong>have a table which is loaded with data via ajax asjdklfasjd</strong>
                              <p><span>Logged on: Feb 13 2014</span> <span>Logged by: Abdul Jadid</span> </p>
                            </div> 
                            <p>That means that any event handlers bound to the elements during page load will not be applicable to the loaded data unless the event is delegated to a static parent element -- meaning that the element is never removed or replaced, and will exist indefinitely.</p>
                            <p><span>Customer: UTM</span> <span>Status: Closed</span> </p>
                            </td>
                          </tr> -->
                  <table id="tbl_application" class="table table-hover  tablesorter">
                    <thead>
                      <tr>
                      <th style="width: 50px;">No </th>
                        <th>Incident ID </th>
                        <th>Problem</th>
                        <th>Reported On </th>
                        <th>Reporter </th>
                        <th>Customer </th>
                        <th>Engineer</th>
                        <th>Status </th>
                      </tr>
                     </thead>
                    <tbody>
<?PHP
                    while($row = mysqli_fetch_array($result)){
                        $i++;?>
                      <tr style="border-bottom:1px solid #ddd" data="<?=$row['case_id']?>">
                        <td><?php echo((($page-1) * 10 ) + $i);?></td>
                        <td><?=$row['case_id']?></td>
                        <td><?=$row['title']?></td>
                        <td><?=$row['open_date']?></td>
                        <td><?=$row['open_by']?></td>
                        <td><?=$row['client_code']?></td>
                        <td><?=$row['engineer_name']?></td>
                        <td><?=$row['status']?></td>
                      </tr>
<?PHP
                    }
                    ?>            
                    </tbody>
                  </table>
          <blockquote>
          <p style="padding:5px">Showing page <?=$page?> / <?=$maxpage?> of <?=$total_pages?> records  found</p>
          </blockquote>   
          <div style="float:right;margin-top:-35px;">    
          <div class="btn-group">
            <div class="btn-group dropup">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cog"></i>
              </button>
              <ul class="dropdown-menu">
                <li id="compact_view_btm"><a href="#">Compact View</a></li>
                <li id="details_view_btm"><a href="#">Details View</a></li>
              </ul>
            </div>
            <button id="first-btm" class="btn  btn-small btn-default"><i class="icon-step-backward"></i> </button>
            <button id="prev-btm" class="btn  btn-small btn-default"><i class=" icon-angle-left "></i> </button>
            <button id="next-btm" class="btn  btn-small btn-default">   <i class="icon-angle-right"></i> </button>
            <button id="last-btm" class="btn  btn-small btn-default">  <i class="icon-step-forward "></i> </button>
          </div>    
          </div>
<input type="hidden" id="rpt_max" value="<?=$maxpage?>">
<input type="hidden" id="rpt_page" value="<?=$page?>">

<script src="../js/holder.js"></script>
<script type="text/javascript">
  function navigateTo(page){
    // alert(page);
    // alert($('#fltr').val())
    // alert($('#begin_date').val())
    // alert($('#end_date').val())
      $.ajax({
        async: "false",
        type: "POST",
        url: "app_list_compact.php",
        data: ({
            type       : $('#report_type').val()  ,
            fltr       : $('#fltr').val()  ,
            date_type  : $('#report_date').val()  ,
            begin      : $('#begin_date').val()  ,
            end        : $('#end_date').val(),
            page       : page  
            }) ,

        success: function(data){
          if(data!=""){ 
            $('#div_app_list').html(data);

          }

          else{//true
                valid = false;
                alert('fail')
          }
        } 
      }); 

  }
    $('#tbl_application tbody tr').click(function(){
      window.location.replace("../incident/view.php?app_no="+$(this).attr('data'));
    })
  $( "#prev-top" ).click(function() {
      var page = (parseInt($("#rpt_page").val())-1);
      if (page >= 1)  {
        navigateTo(page)
      }
  });
  $( "#next-top" ).click(function() {
      var page = (parseInt($("#rpt_page").val())+1);
      var max = parseInt($("#rpt_max").val());
      if (page <= max)  {
          navigateTo(page)
      }
    });
  $( "#first-top" ).click(function() {
        var max = parseInt($("#rpt_max").val());
        var page = parseInt($("#rpt_page").val());
        if (page > 1) {
          navigateTo(1);
        };    
  });
  $( "#last-top" ).click(function() {
        var max = parseInt($("#rpt_max").val());
        var page = parseInt($("#rpt_page").val());
        if (max != page) {
          navigateTo(max);
        };
  });


  $( "#prev-btm" ).click(function() {
      var page = (parseInt($("#rpt_page").val())-1);
      if (page >= 1)  {
          navigateTo(page)
      }
  });
  $( "#next-btm" ).click(function() {
      var page = (parseInt($("#rpt_page").val())+1);
      var max = parseInt($("#rpt_max").val());
      if (page <= max)  {
          navigateTo(page)
      }
    });
  $( "#first-btm" ).click(function() {
        var max = parseInt($("#rpt_max").val());
        var page = parseInt($("#rpt_page").val());
        if ( page >1) {
          navigateTo(1);
        };    
    });
  $( "#last-btm" ).click(function() {
        var max = parseInt($("#rpt_max").val());
        var page = parseInt($("#rpt_page").val());
        if (max != page) {
          navigateTo(max);
        };
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

  $('#details_view_top').click(function(){
      $.ajax({
        async: "false",
        type: "POST",
        url: "app_list.php",
        data: ({
            type       : $('#report_type').val()  ,
            fltr       : $('#fltr').val()  ,
            date_type  : $('#report_date').val()  ,
            begin      : $('#begin_date').val()  ,
            end        : $('#end_date').val(),
            page       : 1  
            }) ,

        success: function(data){
          if(data!=""){ 
            $('#div_app_list').html(data);

          }

          else{//true
                valid = false;
                alert('fail')
          }
        } 
      });   })

  $('#details_view_btm').click(function(){
      $.ajax({
        async: "false",
        type: "POST",
        url: "app_list.php",
        data: ({
            type       : $('#report_type').val()  ,
            fltr       : $('#fltr').val()  ,
            date_type  : $('#report_date').val()  ,
            begin      : $('#begin_date').val()  ,
            end        : $('#end_date').val(),
            page       : 1  
            }) ,

        success: function(data){
          if(data!=""){ 
            $('#div_app_list').html(data);

          }

          else{//true
                valid = false;
                alert('fail')
          }
        } 
      });   })
  
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