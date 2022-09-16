
<?
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "inventory";
include ("../../nav/header.php");
if ($access_control == "true") {
?>
    <script src='../../js/jquery.autosize.js'></script>
<?
if(isset($_GET['case_id'])){
    include 'DB.php';
    $case_id     =   htmlspecialchars(trim($_GET['case_id']));
    $sqlquery   =   "SELECT * FROM casesaddr where case_id = '$case_id'";
    $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
    $row        =   mysqli_fetch_array( $result );

}
?>

<input type="hidden" id="case_id" value="<?if(isset($case_id)){echo $case_id;}?>">
<input type="hidden" id="client" value="<?if(isset($row['client_code'])){echo $row['client_code'];}?>">
<input type="hidden" id="report_channel" value="<?if(isset($row['via'])){echo $row['via'];}?>">
<input type="hidden" id="service_type" value="<?if(isset($row['servType'])){echo $row['servType'];}?>">
<input type="hidden" id="category" value="<?if(isset($row['cat'])){echo $row['cat'];}?>">
<input type="hidden" id="product" value="<?if(isset($row['product'])){echo $row['product'];}?>">
<input type="hidden" id="severity" value="<?if(isset($row['flag'])){echo $row['flag'];}?>">


      <div id="page-wrapper" >
          <div class="col-lg-12">
            <h1>Machine <small>Classify every machine</small></h1>
            <ol class="breadcrumb">
              <li ><a href="../index.php"><i class="fa fa-inbox"></i> Inventory</a></li>
              <li class="active"><i class="icon-file-alt"></i> New Machine Type</li>
            </ol>

          </div>
        <form class="form-horizontal" role="form" style="margin-top:10px">     
        <div class="col-md-9 with-sidebar">

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
                    <input id="machine_type" name="full-name" type="text" placeholder="Machine Type" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Brand</label>
                <div class="col-sm-7">
                    <input id="machine_brand" name="full-name" type="text" placeholder="Brand" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>        
            <div class="form-group">
                <label class="col-sm-4 control-label">Model </label>
                <div class="col-sm-7">
                    <input id="machine_model" name="full-name" type="text" placeholder="Model" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div> 
   
            <div class="" style="text-align:center;margin:20px;width:100%">
                <a id="btn_save_machine" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Save</a>  
                <a id="btn_cancel_machine" class="btn btn-default">Cancel</a>
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
                            <li><a href="../new.php">Add New Product</a></li>
                        </ul>
                    </p>                                        
                </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">

    $('#machine_spec').autosize();
    $('select#machine_client').load('../../lookup/client_filtered.php?selected='+'&code=2048', function() {  })    
    $('select#machine_project').load('../../lookup/project_filtered.php?client=&selected='+'&code=2048', function() {  })    
    $('select#machine_client').change(function(){
        $('select#machine_project').load('../../lookup/project_filtered.php?client='+$('#machine_client').val()+'&selected='+'&code=2048', function() { })                    
    })

    $('select#machine_project').change(function(){
        var project_code = $(this).val();
        var client = project_code.substring(0,(project_code.length-2));
        $( 'select#machine_client').load('../../lookup/client_filtered.php?selected='+client+'&code=2048', function() {  })         
    })

   $('#btn_save_machine').click(function(){
        var valid = false;
          $.ajax({
            async: "false",
            type: "POST",
            url: "save.php",
            data: ({
                client  : $("#machine_client").val()  ,
                project : $("#machine_project").val()  ,
                type    : $("#machine_type").val()  ,
                brand   : $("#machine_brand").val()  ,
                model   : $("#machine_model").val()  ,
                spec    : $("#machine_spec").val()  

                  }) ,

            success: function(data){
              if(data=="SAVED"){ 
                alert('New machine successfully saved.')
                window.location.href="index.php";

              }

              else{//true
                    valid = false;
                    alert('fail')
              }
            } 
          }); 
    })
   $('#btn_cancel_machine').click(function(){
    window.location.replace("index.php");
    })   
</script>
<?
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>
