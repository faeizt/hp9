
<?php
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "config";
include ("../../nav/header.php");
if ($access_control2 == "true") {
?>    
  <script src='../../js/jquery.autosize.js'></script>

     <div id="page-wrapper" >
              <div class="col-lg-12">
                <h1>Contract <small>Register New Contract</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                      <li class=""><a href="../../config/project"><i class="fa fa-fw fa-briefcase "></i> Contract</a></li>
                      <li class="active"><i class="fa fa-fw fa-plus "></i> Add Contract</li>

                </ol>
              </div>
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="incident_site_id">
        <input type="hidden" id="incident_addr_id">        
        <input type="hidden" id="incident_sla">        
        <div class="col-md-9  with-sidebar">
            <div class="form-group">
                <label class="col-sm-4 control-label">Contract Name</label>
                <div class="col-sm-7">
                    <input id="project_name" name="full-name" type="text" placeholder="Contract Name" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Description</label>
                <div class="col-sm-7">
                    <textarea id="project_description" 
                    class="form-control" Placeholder="Contract Description"></textarea>
                    <p class="help-block"></p>
                </div>
            </div>            
            <div class="form-group">
                <label class=" col-sm-4 control-label">Choose Client</label>
                <div class="col-sm-7">
                    <select id="project_client" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label">Sales Order #</label>
                <div class="col-sm-7">
                    <input id="project_contract" type="text" placeholder="Sales Order #" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>    
            <div class="form-group">
                <label class="col-sm-4 control-label">Account Manager </label>
                <div class="col-sm-7">
                    <input id="project_am" type="text" placeholder="Account Manager Name" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>              
            <div class="form-group" style="display:none">
                <label class="col-sm-4 control-label">Contract Manager</label>
                <div class="col-sm-7">
                    <input id="project_pm" type="text" placeholder="Contract Manager Name" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group" style="display:none">
                <label class="col-sm-4 control-label">Client Contract Manager</label>
                <div class="col-sm-7">
                    <input id="project_cpm" type="text" placeholder="Client Contract Manager Name" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Start Date</label>
                <div class="col-sm-7">
                    <input id="project_start" type="text" placeholder="Start Date" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">End Date</label>
                <div class="col-sm-7">
                    <input id="project_end" type="text" placeholder="End Date" value="" 
                    class="form-control">
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
      $('select#project_client').load('../../lookup/client.php?selected=', function() {  })    

           $('#btn_save_project').click(function(){
           	
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "save.php",
                    data: ({
                          project_name        : $( "#project_name" ).val(),
                          project_descr       : $( "#project_description" ).val(),
                          project_client      : $( "#project_client" ).val(),
                          project_contract    : $( "#project_contract" ).val(),
                          project_am          : $( "#project_am" ).val(),
                          project_pm          : $( "#project_pm" ).val(), 
                          project_cpm         : $( "#project_cpm" ).val(), 
                          project_start       : $( "#project_start" ).val(), 
                          project_end         : $( "#project_end" ).val()
                        }),
                    success: function(data){
                      if(data=="SAVED"){ 
                        alert('Information saved successfully.')
                        window.location.href = "index.php";

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
<?php
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>
