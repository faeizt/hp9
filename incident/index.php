<?php
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "incident";
include ("../nav/header.php");
$project      ="";
$project_code ="";

foreach ($result_array as $results) {
    $project      = $project .$results['project_code'] . ",";
    $project_code = $project_code ."'".$results['project_code'] . "',";

}
$project = substr($project,0,-1);
$project_code = substr($project_code,0,-1);

if ($access_control == "true") {

?>
<input type="hidden" id="project_list" value="<?=$project?>">
<input type="hidden" id="project_code_list" value="<?=$project_code?>">
<?php
if (isset($_GET['date_type']) && isset($_GET['begin']) && isset($_GET['end'])) {?>
<input type="hidden" id="date_type" value="<?=$_GET['date_type']?>">
<input type="hidden" id="begin_date" value="<?=$_GET['begin']?>">
<input type="hidden" id="end_date" value="<?=$_GET['end']?>"><?php                }
?>
<!-- Submenu Navigation -->
<nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header  visible-xs">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".submenu-colls">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>   
    <a class="navbar-brand" > <FONT color="3ca6fb">Submenu &nbsp;</FONT></a>
  </div>   
  <div id="myScrollspy" class="collapse navbar-collapse  submenu-colls">
    <ul class="nav navbar-nav-thin navbar-nav-leftborder-light vert-menu-border">
      <li><a href="new.php"><span class="glyphicon glyphicon-plus"></span> New Incident</a></li>
    </ul>          
  </div><!--/.nav-collapse -->
</nav><!--/.navbar-default -->
<!-- end of Submenu -->
<input type="hidden" id="rpt_page" value="1">
<input type="hidden" id="srcht" value="">
<input type="hidden" id="fltr2" value="">
<input type="hidden" id="fltrt1" value="<?=$_SESSION['def_project']?>">
<input type="hidden" id="fltrt2" value="">
<input type="hidden" id="fltrt3" value="">
<input type="hidden" id="fltrt4" value="">
<input type="hidden" id="fltrt5" value="">
<input type="hidden" id="fltrt6" value="">      
<input type="hidden" id="srt" value="">                
<div id="page-wrapper">
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title">
          <ol class="breadcrumb_date">
            <li class="active"><i class="fa fa-wrench"></i> Incident</li>
            <li class="pull-right" style="margin-top: 0px;">
              <div id="inventory_filter" class="btn btn-success pull-right ">
                  <i class="fa fa-filter fa-sm"></i>
                  <span>Filter</span> <b class="caret"></b>
              </div>
            </li>
          </ol>
          <div id="inventory_filter_div" class="hide">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="form-group">
                    <label class=" col-sm-4 control-label">Choose Client</label>
                    <div class="col-sm-7">
                        <select id="inventory_client" class="form-control" ></select>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">                
                    <label class=" col-sm-4 control-label">Choose Contract</label>
                    <div class="col-sm-7">
                        <select id="inventory_project" class="form-control" ></select>
                        <p class="help-block"></p>
                    </div>                
                </div>
                <div class="form-group">                
                    <label class=" col-sm-4 control-label">Status</label>
                    <div class="col-sm-7">
                        <select id="incident_status" class="form-control" ></select>
                        <p class="help-block"></p>
                    </div>                
                </div>                              
                <div class="form-group">                
                    <div class="col-sm-7">
                        <button id="apply_filter" class="btn btn-success" style="text-align:right">Apply Filter</button>
                    </div>                
                </div>                              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.row -->
    <blockquote id='blockquote'>  <p> </p></blockquote>
    
    <div class="table-responsive" id="div_app_list">              
    </div>
  </div>
</div><!-- /#page-wrapper -->
<script type="text/javascript">
$('select#incident_status').load('../lookup/status.php?selected=', function() {  })    
// alert ($('input#date_type').val());
$('#div_app_list').load('list.php?projects='+$('#project_code_list').val()+'&date_type='+$('input#date_type').val()+'&begin='+$('input#begin_date').val()+'&end='+$('input#end_date').val(), function() {  })  
// $('#div_app_list').load('list.php?projects='+$('#project_code_list').val(), function() {  })    

$('#inventory_filter').click(function(){
  $('#inventory_filter_div').toggle();//change the button label to be 'Show'
});

$('select#inventory_client').load('../lookup/client_filter.php?selected='+$('#client').val()+'&code=256', function() {  })    
$('select#inventory_project').load('../lookup/project_filter.php?client='+$('#inventory_client').val()+'&selected='+$('#project').val()+'&code=256', function() { 
    var project_code = $(this).val();
    // alert(project_code)
    if (project_code!="") {
        $( 'select#inventory_machine').load('../lookup/machine.php?project='+project_code, function() {  })    
    };
})    

$('select#inventory_client').change(function(){
    $('select#inventory_project').load('../lookup/project_filter.php?client='+$('#inventory_client').val()+'&selected='+$('#project').val()+'&code=256', function() { 
    var project_code = $('select#inventory_project').val();
    if (project_code!="") {
        $( 'select#inventory_machine').load('../lookup/machine.php?project='+project_code, function() {  })    
    };
    })                    
})

$('#apply_filter').click(function(){
  $('#blockquote').hide();
  var client  =  $("#inventory_client").val();
  var project = $("#inventory_project").val();
  var status = $("#incident_status").val();
  var fltr = "";
  if(client !=""){
    var fltr = fltr + "client_code = ^"+ client+"^";
    if(project !=""){
      var fltr = fltr + " and project_code = ^"+ project+"^";
      
    }  
  }
  if ((fltr !='') && (status != ''))  {
    var fltr = fltr + " and sts = ^"+ status+"^";
  }
  else if((fltr =='') && (status != '')){
    var fltr = fltr + " sts = ^"+ status+"^";    
  }
  $.ajax({
    async: "false",
    type: "POST",
    url: "list.php",
    data: ({
        fltr          : fltr
        }) ,

    success: function(data){
      if(data!=""){ 
        $('#div_app_list').html(data)
      }

      else{//true
            
            alert('Oppss!! Unable to load list.')
      }
    } 
  }); 
})    
// $('#div_app_list').load('app_list.php',function(responseTxt,statusTxt,xhr){
//      // if(statusTxt=="success")             alert("External content loaded successfully!");
//      if(statusTxt=="error")               alert("Error: "+xhr.status+": "+xhr.statusText);
//  });
$(document).ready(function(){
  // $('#datatables').dataTable();
  var dTable=$("#datatables").dataTable({
    "bProcessing":false,
    "bPaginate":true,
    "bRetrieve":false,
    "bFilter":true,
    "bJQueryUI":true,
    "bAutoWidth":false,
    "bInfo":true,
    "fnPreDrawCallback":function(){
        $("#datatables").hide();
        // $("#loading").show();
        // alert("Pre Draw");
    },
    "fnDrawCallback":function(){
        $("#datatables").show();
        
        // $("#loading").hide();
        // alert("Draw");
    },
    "fnInitComplete":function(){
        // alert("Complete");
        $("#datatables").show();
    }
  })        
})
$(document).on('click', '#datatables tbody tr', function(){
      window.location.replace("view.php?app_no="+$(this).attr('data'));
});
</script>

<?php
}else{
include ("../nav/access_denied.php");
}
include ("../nav/footer.php");
?>