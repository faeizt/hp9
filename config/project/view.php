
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
                <h1>Contract <small>Detail Information</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                  <li class=""><a href="../../config/project"><i class="icon-fire"></i> Contract</a></li>
                  <li class="active"><i class="icon-plus"></i> New Contract</li>
                </ol>
              </div>
      <?
      include '../../DB.php'; //DB Connection String      
      if(isset($_GET['project_code'])){
        $project_code      =   htmlspecialchars(trim($_GET['project_code']));
        $sqlquery         =   "SELECT project.*,DATE_FORMAT(startdate,'%d/%m/%y') start,DATE_FORMAT(enddate,'%d/%m/%y') end FROM project where project_code = '$project_code'"  ;      // echo $sqlquery;
        $result           =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row              =   mysqli_fetch_array( $result );
      }
        ?>              
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="project_id" value="<?if(isset($row['id']))echo $row['id'];?>">     
        <input type="hidden" id="client" value="<?if(isset($row['client_code']))echo $row['client_code'];?>">     
        <div class="col-md-9  with-sidebar">
            <div class="form-group">
                <label class="col-sm-4 control-label">Contract Name</label>
                <div class="col-sm-7">
                    <input id="project_name" name="full-name" type="text" placeholder="Project Name" value="<?if(isset($row['project_name']))echo $row['project_name'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Description</label>
                <div class="col-sm-7">
                    <textarea id="project_description" 
                    class="form-control" Placeholder="Project Description"><?if(isset($row['project_descr']))echo $row['project_descr'];?></textarea>
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
                    <input id="project_contract" type="text" placeholder="Contract Code" value="<?if(isset($row['contract_code']))echo $row['contract_code'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>    
            <div class="form-group">
                <label class="col-sm-4 control-label">Account Manager </label>
                <div class="col-sm-7">
                    <input id="project_am" type="text" placeholder="Account Manager Name" value="<?if(isset($row['accountmanager']))echo $row['accountmanager'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>              
            <div class="form-group" style="display:none">
                <label class="col-sm-4 control-label">Project Manager</label>
                <div class="col-sm-7">
                    <input id="project_pm" type="text" placeholder="Project Manager Name" value="<?if(isset($row['projectmanager']))echo $row['projectmanager'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group" style="display:none">
                <label class="col-sm-4 control-label">Client Project Manager</label>
                <div class="col-sm-7">
                    <input id="project_cpm" type="text" placeholder="Client Project Manager Name" value="<?if(isset($row['clientpm']))echo $row['clientpm'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Start Date</label>
                <div class="col-sm-7">
                    <input id="project_start" type="text" placeholder="Start Date" value="<?if(isset($row['start']))echo $row['start'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">End Date</label>
                <div class="col-sm-7">
                    <input id="project_end" type="text" placeholder="End Date" value="<?if(isset($row['end']))echo $row['end'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>            
           
            <div class="" style="text-align:center;margin:20px;width:100%"> 
              <a id="btn_save_project" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Update</a>  
              <a id="btn_rm_project" class="btn btn-danger"><i class="fa fa-fw  fa-trash-o"></i> Remove</a>
              <a id="btn_cancel_project" class="btn btn-default">Cancel</a>
            </div>
        </div>
        <div class="col-md-3 form-sidebar">
<!--           <div class="alert alert-info">
              <span style="font-size:20px;font-weight:bold"><i class="icon-lightbulb pull-left"></i></span>
              Please make sure all informations are correct before submitting the incident.
          </div>     -->    
          <p>Scheduled Events<hr/></p>
          <p>
              <ol type="1"><?
                $sqlquery = "SELECT id,owner,title, DATE_FORMAT(BEGIN,'%d/%m/%Y') begin, DATE_FORMAT(END,'%d/%m/%Y') end FROM events where owner='$project_code'";
                $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
                while($row = mysqli_fetch_array($result)){?>
                  <li><?=$row['title']?> (<?=$row['begin']?>)</li><?
                }?>                               
              </ol>
          </p>  
          <p>
            <br/>
          </p>                        
          <p>Related Links<hr/></p>
          <p>
              <ul>
                  <li><a href="scheduler/?project_code=<?=$project_code?>">Schedule Events</a></li>
              </ul>
          </p>
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
          $('select#project_client').load('../../lookup/client.php?selected='+$('#client').val(), function() {  })    

           $('#btn_save_project').click(function(){
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "save.php",
                    data: ({
                          id                  : $( "#project_id" ).val(),
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
                        alert('Information saved successfully')
                        window.location.href="index.php";
                      }

                      else{//true
                            valid = false;
                            alert('Unable to save information.')
                      }
                    } 
                  }); 
            })
           $('#btn_rm_project').click(function(){
            
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "remove.php",
                    data: ({
                        id  : $("#project_id").val()  
                        }) ,

                    success: function(data){
                      // alert(data)
                      if(data=="true"){ 
                        alert('Information successfully removed.')                        
                        window.location.replace("index.php");

                      }

                      else{//true
                            valid = false;
                            alert('Unable to remove information.')
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
