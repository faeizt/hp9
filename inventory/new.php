
<?php
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "inventory";
include ("../nav/header.php");
if ($access_control == "true") {
?>
<?php
if(isset($_GET['case_id'])){
    include 'DB.php';
    $case_id     =   htmlspecialchars(trim($_GET['case_id']));
    $sqlquery   =   "SELECT * FROM casesaddr where case_id = '$case_id'";
    $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
    $row        =   mysqli_fetch_array( $result );

}
?>
      <div id="page-wrapper" >
          <div class="col-lg-12">
            <h1>Product List <small>Track all Inventories</small></h1>
            <ol class="breadcrumb">
              <li ><a href="index.php"><i class="fa fa-inbox"></i> Product List</a></li>
              <li class="active"><i class="icon-plus"></i> Add Product List</li>
            </ol>

          </div>
        <form class="form-horizontal" role="form" style="margin-top:10px">  
        <div class="col-md-9  with-sidebar">

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
                <label class="col-sm-4 control-label">Machine Type</label>
                <div class="col-sm-7">
                    <select id="inventory_machine" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Serial Number</label>
                <div class="col-sm-7">
                    <input id="inventory_sn" name="full-name" type="text" placeholder="Serial Number" value="" 
                    class="form-control UCASE">
                    <p class="help-block"></p>
                </div>
            </div>     
            <div class="form-group">
                <label class="col-sm-4 control-label">Specification</label>
                <div class="col-sm-7">
                    <textarea name="info" id="inventory_spec" class="form-control" style="height:100px;margin-top:5px" placeholder="Specification"></textarea>
                    <p class="help-block"></p>
                </div>           
            </div>            
            <div class="" style="text-align:center;margin:20px;width:100%">
                <a id="btn_save_inventory" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Save</a>  
                <a id="btn_cancel_inventory" class="btn btn-default">Cancel</a>
            </div>

        </div>
<div class="col-md-3 form-sidebar">
                    <div class="alert alert-info">
                        <span style="font-size:20px;font-weight:bold"><i class="icon-lightbulb pull-left"></i></span>
                        Please make sure all informations are correct before submitting the form.
                    </div>                        
                    <p>Related Links<hr/></p>
                    <p>
                        <ul>
                            <li><a href="machine">Machine Type</a></li>
                            <li><a href="machine/new.php">Add New Machine Type</a></li>
                        </ul>
                    </p>
                </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">
    $('select#inventory_client').load('../lookup/client_filtered.php?selected='+$('#client').val()+'&code=4096', function() {  })    
    $('select#inventory_project').load('../lookup/project_filtered.php?client='+$('#inventory_client').val()+'&selected='+$('#project').val()+'&code=4096', function() { 
        var project_code = $(this).val();
        // alert(project_code)
        if (project_code!="") {
            $( 'select#inventory_machine').load('../lookup/machine.php?project='+project_code, function() {  })    
        };
    })    

    $('select#inventory_client').change(function(){
        $('select#inventory_project').load('../lookup/project_filtered.php?client='+$('#inventory_client').val()+'&selected='+$('#project').val()+'&code=4096', function() { 
        var project_code = $('select#inventory_project').val();
        if (project_code!="") {
            $( 'select#inventory_machine').load('../lookup/machine.php?project='+project_code, function() {  })    
        };
       })                    
    })

    $('select#inventory_project').change(function(){
        var project_code = $(this).val();
        var client = project_code.substring(0,(project_code.length-2));
        $( 'select#inventory_client').load('../lookup/client_filtered.php?selected='+client+'&code=4096', function() {  })    
        $( 'select#inventory_machine').load('../lookup/machine.php?selected='+project_code, function() {  })    
    })

   $('#btn_save_inventory').click(function(){            
        var valid = true;
        if($("#inventory_client").val()==""){alert('Please choose client'); valid=false;}
        else if($("#inventory_project").val()==""){alert('Please choose project'); valid=false;}
        else if($("#inventory_machine").val()==""){alert('Please choose machine type'); valid=false;}
        else if($("#inventory_sn").val()==""){alert('Serial Number is a mandatory field'); valid=false;}
        if (valid) {
          $.ajax({
            async: "false",
            type: "POST",
            url: "save.php",
            data: ({
                client          : $("#inventory_client").val()  ,
                project         : $("#inventory_project").val()  ,
                machine         : $("#inventory_machine").val()  ,
                sn              : $("#inventory_sn").val()  ,
                spec              : $("#inventory_spec").val()  



                  }) ,

            success: function(data){
              if(data=="SAVED"){ 
                alert('New product successfully added.')
                window.location.replace("index.php");

              }

              else{//true
                    valid = false;
                    alert('Unable to add product.')
              }
            } 
          }); 
        }
    })
   $('#btn_cancel_inventory').click(function(){            
                window.location.replace("index.php");

    })
</script>
<?php
}else{
include ("../nav/access_denied.php");
}
include ("../nav/footer.php");
?>
