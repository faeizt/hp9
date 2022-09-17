
<?php
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "config";
include ("../../nav/header.php");
if ($access_control2 == "true") {
?>
      <?
      include '../../DB.php'; //DB Connection String

      if(isset($_GET['user_id'])){
        $user_id      =   htmlspecialchars(trim($_GET['user_id']));
        $sqlquery         =   "SELECT * FROM sys_users where user_id = '$user_id'"  ;      // echo $sqlquery;
        $result           =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row              =   mysqli_fetch_array( $result );
      }
        ?>      <script src='../../js/jquery.autosize.js'></script>

     <div id="page-wrapper" >
              <div class="col-lg-12">
                <h1>User <small>Detail Information</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                  <li class=""><a href="../../config/user"><i class="icon-fire"></i> User</a></li>
                  <li class=""><i class="icon-pencil"></i> Update</li>
                  <li class="active"><i class="icon-user"></i> <?if(isset($row['username']))echo $row['username'];?></li>
                </ol>
              </div>
          
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="role" value="<?if(isset($row['role_id']))echo $row['role_id'];?>">     
        <input type="hidden" id="specialization" value="<?if(isset($row['specialization']))echo $row['specialization'];?>">     
        <input type="hidden" id="user_id" value="<?if(isset($row['user_id']))echo $row['user_id'];?>">     
        <input type="hidden" id="profile_access" value="<?if(isset($row['access']))echo $row['access'];?>">
        <input type="hidden" id="profile_access2" value="<?if(isset($row['access2']))echo $row['access2'];?>">

        <div class="col-md-9  with-sidebar">
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-credit-card"></i> Username </label>
                <div class="col-sm-6">
                    <input id="profile_username" name="full-name" type="text" placeholder="Username" value="<?if(isset($row['username']))echo $row['username'];?>"
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div> 
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-credit-card"></i> Full Name </label>
                <div class="col-sm-6">
                    <input id="profile_name" name="full-name" type="text" placeholder="Full Name" value="<?if(isset($row['name']))echo $row['name'];?>"
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>   
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-briefcase"></i> Position </label>
                <div class="col-sm-6">
                    <input id="profile_position" name="full-name" type="text" placeholder="Designation" value="<?if(isset($row['designation']))echo $row['designation'];?>"
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>   
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-phone"></i> Office Phone Number </label>
                <div class="col-sm-6">
                    <input id="profile_phone" name="full-name" type="text" placeholder="Office Phone Number" value="<?if(isset($row['phone']))echo $row['phone'];?>"
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>   
            <div class="form-group">
                <label class="col-sm-4 control-label"> <i class="fa fa-tablet"></i> Mobile Phone Number</label>
                <div class="col-sm-6">
                    <input id="profile_mobile" name="full-name" type="text" placeholder="Mobile Phone Number" value="<?if(isset($row['mobile']))echo $row['mobile'];?>"
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>          
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-envelope"></i> Email Address</label>
                <div class="col-sm-6">
                    <input id="profile_email" name="full-name" type="text" placeholder="Email Address" value="<?if(isset($row['email']))echo $row['email'];?>"
                    class="form-control"> 
                    <p class="help-block"></p>
                </div>
            </div> 
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-bookmark "></i> Specialization</label>
                <div class="col-sm-6">
                    <select id="profile_specialization" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>                 
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-bookmark "></i> Skill Sets</label>
                <div class="col-sm-6">
                    <input id="profile_skillset" name="full-name" type="text" placeholder="Skill Sets" value="<?if(isset($row['skillset']))echo $row['skillset'];?>"
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>     
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-star "></i> System Role</label>
                <div class="col-sm-6">
                    <select id="profile_role" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>                                                                       
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-key "></i> Password</label>
                <div class="col-sm-6">
                    <input id="profile_password" name="full-name" type="password" placeholder="Password" value="<?if(isset($row['password']))echo "dmmypaswd";?>"
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-key "></i> Retype Password</label>
                <div class="col-sm-6">
                    <input id="profile_re_password" name="full-name" type="password" placeholder="Retype Password" value="<?if(isset($row['password']))echo "dmmypaswd";?>"
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div> 
            <div class="" style="text-align:center;margin:20px;width:100%"> 
              <a id="btn_save_user" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Update</a>  
              <a id="btn_rm_user" class="btn btn-danger"><i class="fa fa-fw  fa-trash-o"></i> Remove</a>
              <a id="btn_cancel_user" class="btn btn-default">Cancel</a>
            </div>

          </div>

        <div class="col-md-3 form-sidebar">
            <div class="alert alert-info">
                <span style="font-size:20px;font-weight:bold"><i class="icon-lightbulb pull-left"></i></span>
                Please make sure all informations are correct before submitting the form.
            </div>                        
            <p>Related Links</p><hr><p></p>
            <p>
                </p><ul>
                    <li><a href="assign_project?user_id=<?=$user_id?>">Project Access Control</a></li>
                    <li><a href="access?user_id=<?=$user_id?>">System Access Control</a></li>
                </ul>
            <p></p>
        </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">  
          $('select#profile_role').load('../../lookup/role.php?selected='+$('#role').val(), function() {  })    
          $('select#profile_specialization').load('../../lookup/specialization.php?selected='+$('#specialization').val(), function() {  })    
          $('select#profile_role').change(function(){
                $('#profile_access').val($('option:selected',this).attr('access'));
                $('#profile_access2').val($('option:selected',this).attr('access2'));
           });

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
                                                        access: $("#profile_access").val(),
                            access2: $("#profile_access2").val(),

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
