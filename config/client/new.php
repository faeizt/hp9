
<?
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "config";
include ("../../nav/header.php");
if ($access_control2 == "true") {
?>
     <div id="page-wrapper" >
              <div class="col-lg-12">
                <h1>Client <small>Register New Client</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                  <li class=""><a href="../../config/client"><i class="icon-fire"></i> Client</a></li>
                  <li class="active"><i class="icon-plus"></i> New Client</li>
                </ol>
              </div>
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="incident_site_id">
        <input type="hidden" id="incident_addr_id">        
        <input type="hidden" id="incident_sla">        
        <div class="col-md-9  with-sidebar">
        <div class="form-group">
                <label class="col-sm-4 control-label">Client Name</label>
                <div class="col-sm-7">
                    <input id="client_name" name="full-name" type="text" placeholder="Client Name in full" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>            

            <div class="form-group">
                <label class="col-sm-4 control-label">Client Code</label>
                <div class="col-sm-7">
                    <input id="client_code" name="full-name" type="text" placeholder="Client Code" value="" 
                    class="form-control">
                    <p class="help-block">e.g:TM,MARA, KWSP</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Acronym</label>
                <div class="col-sm-7">
                    <input id="client_acronym" name="full-name" type="text" placeholder="Acronym" value="" 
                    class="form-control">
                    <p class="help-block">e.g:TM,MARA, KWSP</p>
                </div>
            </div>            
            <div class="" style="text-align:center;margin:20px;width:100%">
				<a id="btn_save_client" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Save</a>  
				<a id="btn_cancel_client" class="btn btn-default">Cancel</a>
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
           $('#btn_save_client').click(function(){
           	
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "save.php",
                    data: ({
                        code            : $("#client_code").val()  ,
                        acronym         : $("#client_acronym").val()  ,
                        name            : $("#client_name").val()  
                          }) ,

                    success: function(data){
                    	// alert(data)
                      if(data=="SAVED"){ 
                        window.location.replace("index.php");

                      }

                      else{//true
                            valid = false;
                            alert('Unable to save information.')
                      }
                    } 
                  }); 
            })
           $('#btn_cancel_client').click(function(){
                        window.location.replace("index.php");
            })                      
    </script>
<?
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>
