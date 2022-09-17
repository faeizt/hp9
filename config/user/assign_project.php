
<?php
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "config";
include ("../../nav/header.php");
if ($access_control2 == "true") {
?>
  <?
  include '../../../DB.php'; //DB Connection String

  if(isset($_GET['user_id'])){
    $user_id      =   htmlspecialchars(trim($_GET['user_id']));
    $sqlquery         =   "SELECT * FROM sys_users where user_id = '$user_id'"  ;      // echo $sqlquery;
    $result           =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
    $row              =   mysqli_fetch_array( $result );
  }
    ?>  
     <div id="page-wrapper" >
              <div class="col-lg-12">
                <h1>Project Assignment <small>Detail Information</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                  <li class=""><a href="../../config/project"><i class="icon-fire"></i> User</a></li>
                  <li class="active"><i class="icon-briefcase"></i> Assign Project</li>
                  <li class="active"><i class="icon-user"></i> <?if(isset($row['username']))echo $row['username'];?></li>
                </ol>
              </div>
            
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="role" value="<?if(isset($row['role_id']))echo $row['role_id'];?>">     
        <input type="hidden" id="specialization" value="<?if(isset($row['specialization']))echo $row['specialization'];?>">     
        <input type="hidden" id="user_id" value="<?if(isset($row['user_id']))echo $row['user_id'];?>">     
        <div class="col-md-9  with-sidebar">
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-bookmark "></i> Client</label>
                <div class="col-sm-6">
                    <select id="assign_client" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>                 
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-star "></i> Project</label>
                <div class="col-sm-6">
                    <select id="assign_project" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-star "></i> Project Role</label>
                <div class="col-sm-6">
                    <input type="hidden" id="assign_project_role">
                    <p class="help-block"><input type="checkbox"> Administrator</p>
                    <p class="help-block"><input type="checkbox"> Manager</p>
                    <p class="help-block"><input type="checkbox"> Engineer</p>
                </div>
            </div>                                                                       

            <div class="" style="text-align:center;margin:20px;width:100%"> 
              <a id="btn_save_user" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Update</a>  
              <a id="btn_rm_user" class="btn btn-danger"><i class="fa fa-fw  fa-trash-o"></i> Remove</a>
              <a id="btn_cancel_user" class="btn btn-default">Cancel</a>
            </div>

          </div>

        <div class="col-md-3 form-sidebar">                     
            <p>Assigned Project</p><hr><p></p>
            <p>
                </p><ol type="1">
                    <li><a href="assign_project.php">Projek Sewaan PC Dell(T1650) & Printer OKI - Administrator</a></li>
                    
                </ol>
            <p></p>
        </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">  
    $('select#assign_client').load('../../lookup/client.php?selected='+$('#client').val(), function() {  })    
    $('select#assign_project').load('../../lookup/project.php?client='+$('#assign_client').val()+'&selected='+$('#project').val(), function() {  })    

    $('select#assign_client').change(function(){
        $('select#assign__project').load('../../lookup/project.php?client='+$('#inventory_client').val()+'&selected='+$('#project').val(), function() { 
       //  var project_code = $('select#inventory_project').val();
       //  if (project_code!="") {
       //      $( 'select#inventory_machine').load('../lookup/machine.php?selected='+project_code, function() {  })    
       //  };
        })                    
    })

    $('select#assign_project').change(function(){
        var project_code = $(this).val();
        var client = project_code.substring(0,(project_code.length-2));
        $( 'select#assign_client').load('../../lookup/client.php?selected='+client, function() {  })    
        // $( 'select#inventory_machine').load('../lookup/machine.php?selected='+project_code, function() {  })    
    })

          $('select#profile_role').load('../../lookup/role.php?selected='+$('#role').val(), function() {  })    
          $('select#profile_specialization').load('../../lookup/specialization.php?selected='+$('#specialization').val(), function() {  })    
           $('#btn_save_user').click(function(){
                var valid = true;
                if($("#profile_password").val() != $("#profile_re_password").val()){alert('Opps!! your password not matched.');valid=false;}
                if(valid){
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "save.php",
                    data: ({
                            user_id: $("#user_id").val(),
                            username: $("#profile_username").val(),
                            name: $("#profile_name").val()  ,
                            designation: $("#profile_position").val()  ,
                            phone: $("#profile_phone").val()  ,
                            mobile: $("#profile_mobile").val()  ,
                            email: $("#profile_email").val()  ,
                            specialization: $("#profile_specialization").val(),
                            skillset: $("#profile_skillset").val(),
                            role: $("#profile_role").val(),
                            password: $("#profile_password").val()    

                          }) ,

                    success: function(data){
                      // alert(data)
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
                }
            })
           $('#btn_rm_user').click(function(){
            
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "remove.php",
                    data: ({
                        user_id  : $("#user_id").val()
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
           $('#btn_cancel_user').click(function(){
                        window.location.replace("index.php");
            })           
    </script>
<?php
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>
