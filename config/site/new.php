
<?
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "config";
include ("../../nav/header.php");
if ($access_control2 == "true") {
?>    
  <script src='../../js/jquery.autosize.js'></script>

     <div id="page-wrapper" >
              <div class="col-lg-12">
                <h1>Client Site <small>Register New Client Site</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                      <li class=""><a href="../../config/site"><i class="fa fa-fw fa-briefcase "></i> Client Site</a></li>
                      <li class="active"><i class="fa fa-fw fa-plus "></i> Add Client Site</li>

                </ol>
              </div>
        <form class="form-horizontal" role="form" style="margin-top:10px">    
        <div class="col-md-9  with-sidebar">
            <div class="form-group">
                <label class=" col-sm-4 control-label">Choose Client</label>
                <div class="col-sm-7">
                    <select id="site_client" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>          
            <div class="form-group">
                <label class=" col-sm-4 control-label">Choose Project</label>
                <div class="col-sm-7">
                    <select id="site_project" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>                
            <div class="form-group">
                <label class="col-sm-4 control-label">Site Name</label>
                <div class="col-sm-7">
                    <input id="site_name" name="full-name" type="text" placeholder="Site Name" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Address Line 1</label>
                <div class="col-sm-7">
                    <input id="site_addr_1" name="full-name" type="text" placeholder="Address Line 1" value="" 
                    class="form-control">
                    <p class="help-block">e.g: Block No, Building name</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Address Line 2</label>
                <div class="col-sm-7">
                    <input id="site_addr_2" name="full-name" type="text" placeholder="Address Line 2" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Postcode</label>
                <div class="col-sm-7">
                    <input id="site_postcode" name="full-name" type="text" placeholder="Postcode number" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">City</label>
                <div class="col-sm-7">
                    <input id="site_city" name="full-name" type="text" placeholder="City" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-4 control-label">Choose State</label>
                <div class="col-sm-7">
                    <select id="site_state" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>  
            <div class="" style="text-align:center;margin:20px;width:100%">
				<a id="btn_save_project" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Save</a>  
				<a id="btn_cancel_project" class="btn btn-default">Cancel</a>
            </div>
        </div>
<div class="col-md-3 form-sidebar">
                    <div class="alert alert-info">
                        <span style="font-size:20px;font-weight:bold"><i class="icon-lightbulb pull-left"></i></span>
                        Please make sure all informations are correct before submitting the incident.
                    </div>                        

                </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">
      $('#project_description').autosize();
      $('#project_start').datepicker({
        dateFormat: 'dd/mm/yy'
      });
      $('#project_end').datepicker({
        dateFormat: 'dd/mm/yy'
      });      
      $('select#site_client').load('../../lookup/client.php?selected=', function() {  })    
      $('select#site_state').load('../../lookup/state.php?selected=', function() {  })    
      $('select#site_client').change(function(){
          $('select#site_project').load('../../lookup/project.php?client='+$('#site_client').val()+'&selected='+$('#project').val(), function() { })
      });

           $('#btn_save_project').click(function(){
           	
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "save.php",
                    data: ({
                          client       : $( "#site_client" ).val(),
                          project       : $( "#site_project" ).val(),
                          name         : $( "#site_name" ).val(),
                          addr_1       : $( "#site_addr_1" ).val(),
                          addr_2       : $( "#site_addr_2" ).val(),
                          postcode     : $( "#site_postcode" ).val(),
                          city         : $( "#site_city" ).val(), 
                          state        : $( "#site_state" ).val()
                        }),
                    success: function(data){
                      if(data=="SAVED"){ 
                        alert('Information saved successfully.')
                        window.location.replace("index.php");

                      }

                      else{//true
                            valid = false;
                            alert('Unable to save information.')
                      }
                    } 
                  }); 
            })
           $('#btn_cancel_project').click(function(){
                        window.location.replace("index.php");
            })                      
    </script>
<?
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>
