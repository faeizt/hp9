<?php
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "config";
include ("../nav/header.php");
if ($access_control == "true") {
$new = false;
if(isset($_GET['user'])){
    include '../DB.php';
    $username     =   htmlspecialchars(trim($_GET['user']));
    $sqlquery   =   "SELECT * FROM sys_users where username = '$username'";
    $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
    $row        =   mysqli_fetch_array( $result );
    $_SESSION['profile_id']=$row['user_id'];
}
else{ 
  $new = true; 
  $_SESSION['profile_id'] = $_SESSION['user_id'];
}
// echo $_SESSION['profile_id']; 
?>
<script type="text/javascript" src="../js/jquery.form.js"></script>
<input type="hidden" id="username" value="<?php if(isset($user)){echo $username;}?>">
<input type="hidden" id="id" value="<?php if(isset($row['user_id'])){echo $row['user_id'];}?>">
<input type="hidden" id="role" value="<?php if(isset($row['role_id'])){echo $row['role_id'];}?>">
<input type="hidden" id="specialization" value="<?php if(isset($row['specialization'])){echo $row['specialization'];}?>">
      <!-- Submenu Navigation -->
      <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header visible-xs">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".submenu-colls">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>   
          <a class="navbar-brand" href="index.html"> <FONT color="3ca6fb">Submenu &nbsp;</FONT></a>

          </div>   
        <div id="myScrollspy" class="collapse navbar-collapse  submenu-colls">
          <ul class="nav navbar-nav-thin navbar-nav-leftborder-light vert-menu-border">
            <!-- <li id="btn_new_application"><a ><span class="glyphicon glyphicon-file"></span> New</a></li> -->
            <?php if(isset($_GET['user'])){?><li id="btn_save_profile"><a ><span class="glyphicon glyphicon-check"></span> Save</a></li><?}else{?>
            <li id="btn_add_profile"><a ><span class="glyphicon glyphicon-check"></span> Add</a></li><?}?>
          </ul>          
        </div><!--/.nav-collapse -->
      </nav><!--/.navbar-default -->

      <div id="page-wrapper" >
          <div class="col-lg-12">
            <h1>Profile <small>User Profile Information</small></h1>
            <ol class="breadcrumb">
              <li><a href=".."><i class="icon-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="icon-user"></i> Profile</li>
              
            </ol>

          </div>
        <div class="col-md-3 <?php if($new == true){?>hide<?}?>" style="margin-top: 20px;">
        <style>
          .preview
          {
          width:200px;
          }
          #preview
          {
          color:#cc0000;
          font-size:12px
          }
          #preview > img{
            display: inline-block;
            height: auto;
            max-width: 100%;
            padding: 4px;
            line-height: 1.428571429;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;        
          }
        </style>        
            <div class=" col-md-offset-1 avatar-box" style="margin-bottom:20px">

                <div class="personal-image" id="preview">
                    <img src="../images/uploads/<?php if(isset($row['profile_image'])){echo $row['profile_image'];}?>" style="width: 200px;" class="avatar img-thumbnail" alt="avatar">

                </div>

            </div>
            <script type="text/javascript" >
             $(document).ready(function() { 
                
                        $('#photoimg').on('change', function()      { 
                            $("#preview").html('');
                            $("#preview").html('<img src="../images/loader.gif" alt="Uploading...."/>');
                            $("#imageform").ajaxForm({
                                  target: '#preview'
                            }).submit();  
                        });
                    }); 
            </script>

            <form id="imageform" class="col-md-offset-1" method="post" enctype="multipart/form-data" action='ajaximage.php'>
              <input type="file" name="photoimg" id="photoimg" />
            </form>


        </div>
        <div class="col-md-9" style="margin-top:20px;border-left: 1px solid #edeff1;box-shadow: inset 3px 0px 4px -1px #fafafa;">
         <div style="clear:both" id="profile_alert-container" class="alert alert-info">
            <i id="profile_alert-icon" class="icon-lightbulb"></i> <span id="profile_alert"> Make your changes & hit save button.</span>
          </div>    
          <fieldset>
          <?php if(!isset($_GET['user'])){?>
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-credit-card"></i> Username </label>
                <div class="col-sm-6">
                    <input id="profile_username" name="full-name" type="text" placeholder="Username" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div> 
            <?}?>   
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-credit-card"></i> Full Name </label>
                <div class="col-sm-6">
                    <input id="profile_name" name="full-name" type="text" placeholder="Full Name" value="<?php if(isset($_GET['user'])){echo $row['name'];}?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>   
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-briefcase"></i> Position </label>
                <div class="col-sm-6">
                    <input id="profile_position" name="full-name" type="text" placeholder="Designation" value="<?php if(isset($_GET['user'])){echo $row['designation'];}?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>   
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-phone"></i> Office Phone Number </label>
                <div class="col-sm-6">
                    <input id="profile_phone" name="full-name" type="text" placeholder="Office Phone Number" value="<?php if(isset($_GET['user'])){echo $row['phone'];}?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>   
            <div class="form-group">
                <label class="col-sm-4 control-label"> <i class="fa fa-tablet"></i> Mobile Phone Number</label>
                <div class="col-sm-6">
                    <input id="profile_mobile" name="full-name" type="text" placeholder="Mobile Phone Number" value="<?php if(isset($_GET['user'])){echo $row['mobile'];}?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>          
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-envelope"></i> Email Address</label>
                <div class="col-sm-6">
                    <input id="profile_email" name="full-name" type="text" placeholder="Email Address" value="<?php if(isset($_GET['user'])){echo $row['email'];}?>" 
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
                    <input id="profile_skillset" name="full-name" type="text" placeholder="Skill Sets" value="<?php if(isset($_GET['user'])){echo $row['skillset'];}?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>     
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-star "></i> System Role</label>
                <div class="col-sm-6">
                    <select id="profile_role" class="form-control" disabled></select>
                    <p class="help-block"></p>
                </div>
            </div>                                                                       
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-key "></i> Password</label>
                <div class="col-sm-6">
                    <input id="profile_password" name="full-name" type="password" placeholder="Password" value="<?php if(isset($_GET['user'])){echo 'dmmypaswd';}?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-key "></i> Retype Password</label>
                <div class="col-sm-6">
                    <input id="profile_re_password" name="full-name" type="password" placeholder="Retype Password" value="<?php if(isset($_GET['user'])){echo 'dmmypaswd';}?>" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>                        
          </fieldset>
        </div>

      </div><!-- /#page-wrapper -->


    <script type="text/javascript">
          $('select#profile_role').load('../lookup/role.php?selected='+$('#role').val(), function() {  })    
          $('select#profile_specialization').load('../lookup/specialization.php?selected='+$('#specialization').val(), function() {  })    
           $('#btn_save_profile').click(function(){
                var valid = true;
                if($("#profile_password").val() != $("#profile_re_password").val()){alert('Opps!! your password not matched.');valid=false;}
                if(valid){
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "profile_save.php",
                    data: ({
                            id: $("#id").val(),
                            username: $("#username").val(),
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
                      if(data=="true"){
                        $('#profile_alert').text("Information successfully saved to database.");
                        $('#profile_alert-icon').removeClass();
                        $('#profile_alert-icon').addClass("icon-ok");
                        $('#profile_alert-container').removeClass("alert-info");
                        $('#profile_alert-container').removeClass("alert-danger");
                        $('#profile_alert-container').addClass("alert-success"); 
                        $('#profile_alert-container').effect("pulsate", { times:2 }, 500);
                       } 
                      else { 
                        $('#profile_alert').text("Opss!!, Unable to save changes.");
                        $('#profile_alert-icon').removeClass();
                        $('#profile_alert-icon').addClass("icon-exclamation-sign");
                        $('#profile_alert-container').removeClass("alert-info");
                        $('#profile_alert-container').addClass("alert-danger");
                        $('#profile_alert-container').effect("pulsate", { times:2 }, 500);
                      }
                     }
                  }); 
                }
            })
           $('#btn_add_profile').click(function(){
                var valid = true;
                if($("#profile_username").val()==""){alert('Username is mandatory field'); valid=false;}
                else if($("#profile_name").val()==""){alert('Full name should not be left empty'); valid=false;}
                else if($("#profile_password").val()==""){alert('Password should not be left empty'); valid=false;}
                else if($("#profile_password").val() != $("#profile_re_password").val()){alert('Opps!! your password not matched.');valid=false;}
                if(valid){
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "profile_add.php",
                    data: ({
                            id: $("#id").val(),
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
                      alert(data)
                      if(data=="true"){
                        $('#profile_alert').text("Information successfully saved to database.");
                        $('#profile_alert-icon').removeClass();
                        $('#profile_alert-icon').addClass("icon-ok");
                        $('#profile_alert-container').removeClass("alert-info");
                        $('#profile_alert-container').removeClass("alert-danger");
                        $('#profile_alert-container').addClass("alert-success"); 
                        $('#profile_alert-container').effect("pulsate", { times:2 }, 500);
                       } 
                      else { 
                        $('#profile_alert').text("Opss!!, Unable to save changes.");
                        $('#profile_alert-icon').removeClass();
                        $('#profile_alert-icon').addClass("icon-exclamation-sign");
                        $('#profile_alert-container').removeClass("alert-info");
                        $('#profile_alert-container').addClass("alert-danger");
                        $('#profile_alert-container').effect("pulsate", { times:2 }, 500);
                      }
                     }
                  }); 
                }
            })
    </script>
<?php
}else{
?>
<div id="page-wrapper" class="panel-body">
  <div class="row">
    <div class="col-lg-12" style="padding:5px">
      <div class="alert alert-danger">
        <span style="font-size:20px;font-weight:bold"><i class="fa fa-exclamation-triangle"></i></span>
        <strong>Access Denied : </strong>You are not authorized to access this page.<br/>
        Please contact System Administrator for help.
      </div> 
    </div>
  </div>  
</div>   
<?php
}
include ("../nav/footer.php");
?>
