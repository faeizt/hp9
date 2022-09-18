
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
                <h1>Client Site <small>Detail Information</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                  <li class=""><a href="../../config/project"><i class="icon-fire"></i> Client Site</a></li>
                  <li class="active"><i class="icon-plus"></i> New  Client Site</li>
                </ol>
              </div>
      <?php
      include '../../DB.php'; //DB Connection String

      if(isset($_GET['site_id'])){
        $site_id      =   htmlspecialchars(trim($_GET['site_id']));
        $sqlquery         =   "SELECT * FROM vclientaddr where site_id = '$site_id'"  ;      // echo $sqlquery;
        $result           =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row              =   mysqli_fetch_array( $result );
      }
        ?>              
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="project" value="<?if(isset($row['project_code']))echo $row['project_code'];?>">     
        <input type="hidden" id="client" value="<?if(isset($row['client_code']))echo $row['client_code'];?>">     
        <input type="hidden" id="state" value="<?if(isset($row['state']))echo $row['state'];?>">     
        <input type="hidden" id="site_id" value="<?if(isset($row['site_id']))echo $row['site_id'];?>">     
        <input type="hidden" id="addr_id" value="<?if(isset($row['addr_id']))echo $row['addr_id'];?>">    
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
                    <input id="site_name" name="full-name" type="text" placeholder="Site Name" value="<?if(isset($row['site_name']))echo $row['site_name'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Address Line 1</label>
                <div class="col-sm-7">
                    <input id="site_addr_1" name="full-name" type="text" placeholder="Address Line 1" value="<?if(isset($row['addr1']))echo $row['addr1'];?>" 
                    class="form-control">
                    <p class="help-block">e.g: Block No, Building name</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Address Line 2</label>
                <div class="col-sm-7">
                    <input id="site_addr_2" name="full-name" type="text" placeholder="Address Line 2" value="<?if(isset($row['addr2']))echo $row['addr2'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Postcode</label>
                <div class="col-sm-7">
                    <input id="site_postcode" name="full-name" type="text" placeholder="Postcode number" value="<?if(isset($row['postcode']))echo $row['postcode'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">City</label>
                <div class="col-sm-7">
                    <input id="site_city" name="full-name" type="text" placeholder="City" value="<?if(isset($row['city']))echo $row['city'];?>" 
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
              <a id="btn_save_site" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Update</a>  
              <a id="btn_rm_site" class="btn btn-danger"><i class="fa fa-fw  fa-trash-o"></i> Remove</a>
              <a id="btn_cancel_site" class="btn btn-default">Cancel</a>
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
          $('select#site_client').load('../../lookup/client.php?selected='+$('#client').val(), function() {  })    
          $('select#site_project').load('../../lookup/project.php?client='+$('#client').val()+'&selected='+$('#project').val(), function() {  })    
          $('select#site_state').load('../../lookup/state.php?selected='+$('#state').val(), function() {  })    
          $('select#site_client').change(function(){
              $('select#site_project').load('../../lookup/project.php?client='+$('#site_client').val()+'&selected='+$('#project').val(), function() { })
          });
           $('#btn_save_site').click(function(){
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "save.php",
                    data: ({
                          site_id      : $( "#site_id" ).val(),
                          addr_id      : $( "#addr_id" ).val(),
                          client       : $( "#site_client" ).val(),
                          project      : $( "#site_project" ).val(),
                          name         : $( "#site_name" ).val(),
                          addr_1       : $( "#site_addr_1" ).val(),
                          addr_2       : $( "#site_addr_2" ).val(),
                          postcode     : $( "#site_postcode" ).val(),
                          city         : $( "#site_city" ).val(), 
                          state        : $( "#site_state" ).val()
                        }),
                    success: function(data){
                      if(data=="SAVED"){ 
                        alert('Information saved successfully')
                        window.location.replace("index.php");
                      }

                      else{//true
                            valid = false;
                            alert('Unable to save information.')
                      }
                    } 
                  }); 
            })
           $('#btn_rm_site').click(function(){
            
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "remove.php",
                    data: ({
                        site_id  : $("#site_id").val(),
                        addr_id  : $("#addr_id").val()  
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
           $('#btn_cancel_site').click(function(){
                        window.location.replace("index.php");
            })           
    </script>
<?php
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>
