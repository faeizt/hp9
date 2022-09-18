
<?php
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "config";
include ("../../nav/header.php");
if ($access_control2 == "true") {
?>
     <div id="page-wrapper" >
              <div class="col-lg-12">
                <h1>Category <small>Detail Information</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                  <li class=""><a href="../../config/category"><i class="icon-fire"></i> Category</a></li>
                  <li class="active"><i class="icon-plus"></i> New Category</li>
                </ol>
              </div>
<?php
      include '../../DB.php'; //DB Connection String

      if(isset($_GET['category_code'])){
        $category_code      =   htmlspecialchars(trim($_GET['category_code']));
        $sqlquery         =   "SELECT * FROM code_definition where code_cat='servicecat' and  code= '$category_code'"  ;      // echo $sqlquery;
        $result           =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row              =   mysqli_fetch_array( $result );
      }
        ?>              
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="category_id" value="<?if(isset($row['code_definition_id']))echo $row['code_definition_id'];?>">     
        <div class="col-md-9  with-sidebar">
            <div class="form-group">
                <label class="col-sm-4 control-label">Category Name</label>
                <div class="col-sm-7">
                    <input id="category" name="full-name" type="text" placeholder="" value="<?if(isset($row['code_name']))echo $row['code_name'];?>" 
                    class="form-control">
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-4 control-label">Description</label>
                <div class="col-sm-7">
                    <input id="category_description" name="full-name" type="text" placeholder="" value="<?if(isset($row['descr']))echo $row['descr'];?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>            
            <div class="" style="text-align:center;margin:20px;width:100%"> 
              <a id="btn_save_category" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Update</a>  
              <a id="btn_rm_category" class="btn btn-danger"><i class="fa fa-fw  fa-trash-o"></i> Remove</a>
              <a id="btn_cancel_category" class="btn btn-default">Cancel</a>
            </div>
        </div>
<div class="col-md-3 form-sidebar">
                    <div class="alert alert-info">
                        <span style="font-size:20px;font-weight:bold"><i class="icon-lightbulb pull-left"></i></span>
                        Please make sure all informations are correct before submitting the changes.
                    </div>                        

                </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">
           $('#btn_save_category').click(function(){
            
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "save.php",
                    data: ({
                        category_id              : $("#category_id").val()  ,
                        category            : $("#category").val()  ,
                        category_description        : $("#category_description").val()  ,
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
           $('#btn_rm_category').click(function(){
            
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "remove.php",
                    data: ({
                      category_id  : $("#category_id").val()  
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
           $('#btn_cancel_category').click(function(){
                        window.location.replace("index.php");
            })           
    </script>
<?php
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>
