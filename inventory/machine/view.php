
<?php
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "inventory";
include ("../../nav/header.php");
if ($access_control == "true") {
?>
    <script src='../../js/jquery.autosize.js'></script>

     <div id="page-wrapper" >
              <div class="col-lg-12">
                <h1>Machine <small>Detail Information</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../config"><i class="icon-cogs"></i> Product List</a></li>
                  <li class=""><a href="../../inventory/machine"><i class="icon-fire"></i> Machine</a></li>
                  <li class="active"><i class="icon-plus"></i> New machine</li>
                </ol>
              </div>
<?php
      include '../../DB.php'; //DB Connection String

      if(isset($_GET['product_id'])){
        $product_id      =   htmlspecialchars(trim($_GET['product_id']));
        $sqlquery         =   "SELECT * FROM product p LEFT JOIN project j ON j.project_code = p.project_code where product_id='$product_id'"  ;      // echo $sqlquery;
        $result           =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row              =   mysqli_fetch_array( $result );
      }
        ?>              
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="machine_id" value="<?if(isset($row['product_id']))echo $row['product_id'];?>">             
        <input type="hidden" id="client" value="<?if(isset($row['client_code']))echo $row['client_code'];?>">     
        <input type="hidden" id="project" value="<?if(isset($row['project_code']))echo $row['project_code'];?>">     
        
        <div class="col-md-9  with-sidebar">
            <div class="form-group">
                <label class=" col-sm-4 control-label">Choose Client</label>
                <div class="col-sm-7">
                    <select id="machine_client" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">                
                <label class=" col-sm-4 control-label">Choose Contract</label>
                <div class="col-sm-7">
                    <select id="machine_project" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>                
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Machine Type</label>
                <div class="col-sm-7">
                    <input id="machine_type" name="full-name" type="text" placeholder="Machine Type" value="<?=$row['product_type']?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Brand</label>
                <div class="col-sm-7">
                    <input id="machine_brand" name="full-name" type="text" placeholder="Brand" value="<?=$row['brand']?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>        
            <div class="form-group">
                <label class="col-sm-4 control-label">Model </label>
                <div class="col-sm-7">
                    <input id="machine_model" name="full-name" type="text" placeholder="Model" value="<?=$row['model']?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div> 
   
            <div class="form-group" style="display:none">
                <label class="col-sm-4 control-label">Specification</label>
                <div class="col-sm-7">
                    <textarea name="info" id="machine_spec" class="form-control" style="height:100px;margin-top:5px" placeholder="Specification"><?=$row['spec']?></textarea>
                    <p class="help-block"></p>
                </div>           
            </div>           
            <div class="" style="text-align:center;margin:20px;width:100%"> 
              <a id="btn_save_machine" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Update</a>  
              <a id="btn_rm_machine" class="btn btn-danger"><i class="fa fa-fw  fa-trash-o"></i> Remove</a>
              <a id="btn_cancel_machine" class="btn btn-default">Cancel</a>
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
    $('#machine_spec').autosize();
    $('select#machine_client').load('../../lookup/client.php?selected='+$('#client').val(), function() {  })    
    $('select#machine_project').load('../../lookup/project.php?client='+$('#client').val()+'&selected='+$('#project').val(), function() {  })    
    $('select#machine_client').change(function(){
        $('select#machine_project').load('../../lookup/project.php?client='+$('#machine_client').val()+'&selected=', function() { })                    
    })

    $('select#machine_project').change(function(){
        var project_code = $(this).val();
        var client = project_code.substring(0,(project_code.length-2));
        $( 'select#machine_client').load('../../lookup/client.php?selected='+client, function() {  })         
    })

           $('#btn_save_machine').click(function(){
            
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "save.php",
                    data: ({
                        id              : $("#machine_id").val()  ,
                        client  : $("#machine_client").val()  ,
                        project : $("#machine_project").val()  ,
                        type    : $("#machine_type").val()  ,
                        brand   : $("#machine_brand").val()  ,
                        model   : $("#machine_model").val()  ,
                        spec    : $("#machine_spec").val()  
                          }) ,

                    success: function(data){
                      // alert(data)
                      if(data=="SAVED"){ 
                        alert('Information successfully saved.')                        
                        window.location.replace("index.php");

                      }

                      else{//true
                            valid = false;
                            alert('Unable to save information.')
                      }
                    } 
                  }); 
            })
           $('#btn_rm_machine').click(function(){
            
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "remove.php",
                    data: ({
                        id  : $("#machine_id").val()  
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
           $('#btn_cancel_machine').click(function(){
                        window.history.back();
            })           
    </script>
<?php
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>
