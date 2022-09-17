<?php
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "inventory";
include ("../../nav/header.php");
if ($access_control == "true") {
?>
      <!-- Submenu Navigation -->
      <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header visible-xs">
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
            <li><a href="new.php"><span class="glyphicon glyphicon-plus"></span> New Machine</a></li>
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
                <li ><a href="../../inventory"><i class="fa fa-inbox"></i> Product List</a></li>
                <li class=""> &nbsp;&nbsp;/ &nbsp;&nbsp;<i class="fa fa-fw fa-cog "></i> Machine</li>
                <li class="pull-right" style="margin-top: 0px;">
                  <div id="inventory_filter" class="btn btn-success pull-right date-picker">
                      <i class="fa fa-filter fa-sm"></i>
                      <span>Filter</span> <b class="caret"></b>
                  </div>
                </li>
              </ol>
                <div id="inventory_filter_div"style="display:block">
                  <div class="panel panel-default">
                    <div class="panel-body" style="">
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
                <div class="table-responsive" id="div_app_list">
                  
                </div>
              </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">
        // $('#div_app_list').load('list.php');
      $('#inventory_filter').click(function(){
        $('#inventory_filter_div').toggle();//change the button label to be 'Show'
      });
      $('select#inventory_client').load('../../lookup/client_filtered.php?selected='+$('#client').val()+'&code=4096', function() {  })    
      $('select#inventory_project').load('../../lookup/project_filtered.php?client='+$('#inventory_client').val()+'&selected='+$('#project').val()+'&code=4096', function() { 
          var project_code = $(this).val();
          // alert(project_code)
          if (project_code!="") {
              $( 'select#inventory_machine').load('../../lookup/machine.php?project='+project_code, function() {  })    
          };
      })    

      $('select#inventory_client').change(function(){
          $('select#inventory_project').load('../../lookup/project_filtered.php?client='+$('#inventory_client').val()+'&selected='+$('#project').val()+'&code=4096', function() { 
          var project_code = $('select#inventory_project').val();
          if (project_code!="") {
              $( 'select#inventory_machine').load('../../lookup/machine.php?project='+project_code, function() {  })    
          };
         })                    
      })
$('#apply_filter').click(function(){
  var client  =  $("#inventory_client").val();
  var project = $("#inventory_project").val();

  var fltr = "";
  if(client !=""){
    var fltr = fltr + "p.client_code = ^"+ client+"^";
    if(project !=""){
      var fltr = fltr + " and p.project_code = ^"+ project+"^";
      
    }    
  }
  else if(client =="" && project !=""){
    var fltr = fltr + " p.project_code = ^"+ project+"^";
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
        })              })
      $(document).on('click', '#datatables tbody tr', function(){
                  window.location.replace("view.php?product_id="+$(this).attr('data'));
            });


    </script>

<?php
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>