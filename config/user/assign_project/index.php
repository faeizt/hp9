
<?php
session_start();
$_SESSION['nav_level'] = "3";
$_SESSION['nav_title'] = "config";
include ("../../../nav/header.php");
if ($access_control2 == "true") {
?>
<?php
  include '../../../DB.php'; //DB Connection String
//    $user_access  = "";

  if(isset($_GET['user_id'])){
    $user_id          =   htmlspecialchars(trim($_GET['user_id']));
    $sqlquery         =   "SELECT * FROM sys_users where user_id = '$user_id'"  ;      // echo $sqlquery;
    $result           =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
    $row              =   mysqli_fetch_array( $result );
  }
    if(isset($_GET['ac'])){
    $ac      =   htmlspecialchars(trim($_GET['ac']));
    $stmt         =   "SELECT ac.*,p.project_name,p.client_code FROM sys_user_ac ac,project p WHERE ac.project_code = p.project_code AND ac.id = '$ac'"  ;      // echo $sqlquery;
    // echo $stmt;
    $access           =   mysqli_query($con,$stmt) or die("sql= ". $stmt);          //query
    $row_ac              =   mysqli_fetch_array( $access );
    $user_access  = $row_ac['access'];
  }
    ?>  
     <div id="page-wrapper" >
              <div class="col-lg-12">
                <h1>Contract Assignment <small>Detail Information</small></h1>
                <ol class="breadcrumb">
                  <li ><a href="../../../config"><i class="icon-cogs"></i> Configuration</a></li>
                  <li class=""><a href="../../../config/user"><i class="icon-fire"></i> User</a></li>
                  <li class=""><a href="../../../config/user/view.php?user_id=<?if(isset($_GET['user_id']))echo $_GET['user_id'];?>"><i class="icon-user"></i> <?if(isset($row['username']))echo $row['username'];?></a></li>
                  <li class="active"><i class="icon-briefcase"></i> Assign Contract</li>
                </ol>
              </div>
            
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="ac" value="<?if(isset($_GET['ac'])) echo $_GET['ac'];?>">     
        <input type="hidden" id="role" value="<?if(isset($row_ac['role']))echo $row_ac['role'];?>">     
        <input type="hidden" id="client" value="<?if(isset($row_ac['client_code']))echo $row_ac['client_code'];?>">     
        <input type="hidden" id="project" value="<?if(isset($row_ac['project_code']))echo $row_ac['project_code'];?>">     
        <input type="hidden" id="user_id" value="<?if(isset($_GET['user_id']))echo $_GET['user_id'];?>">     
        <div class="col-md-9  with-sidebar">
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-bookmark "></i> Client</label>
                <div class="col-sm-6">
                    <select id="assign_client" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>                 
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-star "></i> Contract</label>
                <div class="col-sm-6">
                    <select id="assign_project" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-star "></i> Role</label>
                <div class="col-sm-6">
                    <select id="assign_project_role" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>                                                                                                                                       
<?php

                $sqlquery = "SELECT * FROM access WHERE type='Button' and  description IS NOT NULL order by id";
                $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
                ?>

        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="role" value="<?if(isset($row['role_id']))echo $row['role_id'];?>">     
        <input type="hidden" id="user_id" value="<?if(isset($_GET['user_id']))echo $_GET['user_id'];?>">     

            <div class="form-group">
                <label class="col-sm-4 control-label"><i class="fa fa-star "></i> Access</label>
                <div class="col-sm-6" id="access_form">
                    <input type="hidden" id="assign_access">

<?php
                    $i=0;
                    $access_id=0;
                    while($row_ac_list = mysqli_fetch_array($result)){
                    $i++;
                    $access_id = intval($row_ac_list['access_id']);
                    // echo "accessid = ".$access_id;
                    // echo "access user  = ".$user_access;
                    ?>



                    <p class="help-block"><input type="checkbox" id="<?=$access_id?>" <?if (($user_access & $access_id) == $access_id) { echo 'checked'; } ?>> <?=$row_ac_list['description']?></p>

                    <?}?>

                </div>
            </div>                                                                       

<!--             <div class="" style="text-align:center;margin:20px;width:100%"> 
              <a id="btn_save_access" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Assign</a>  
              <a id="btn_cancel_access" class="btn btn-default">Cancel</a>
            </div>
 -->

            <div class="" style="text-align:center;margin:20px;width:100%"> 
              <a id="btn_assign_project" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Assign</a>  
              <a id="btn_cancel_assign" class="btn btn-default">Cancel</a>
            </div>

     
          </div>

        <div class="col-md-3 form-sidebar">      
<?php
        if(isset($_GET['ac'])) {
          ?>
            <p>Currently Reviewing Access For </p><hr><p></p>
            <p>
                </p><ul>
                    <li><?if(isset($row['username']))echo  "User: ".$row['username'];?></li>
                    <li><?echo  "Contract: ".$row_ac['project_name'];?></li>
                    <li><?echo  "Access Code: ".$row_ac['access'];?></li>
                </ul>
            <p></p>

<?php
        }
        ?>               
            <p>Assigned Contract</p><hr><p></p>
            <p>
                </p><ol type="1" id="role_list">
                    
                </ol>
            <p></p>
        </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">  
    $('select#assign_project_role').load('../../../lookup/role_project.php?selected='+$('#role').val(), function() {  })    
    $('#role_list').load('role_list.php?user_id='+$('#user_id').val(), function() {  })    
    $('select#assign_client').load('../../../lookup/client.php?selected='+$('#client').val(), function() {  })    
    $('select#assign_project').load('../../../lookup/project.php?client='+$('#assign_client').val()+'&selected='+$('#project').val(), function() {  })    

    $('select#assign_client').change(function(){
        $('select#assign_project').load('../../../lookup/project.php?client='+$('#assign_client').val()+'&selected=', function() { 
        var project_code = $('select#assign_project').val();
        if (project_code!="") {
          $.ajax({
            async: "false",
            dataType: "json",
            type: "POST",
            url: "load_privs.php",
            data: ({
                    user_id: $("#user_id").val(),  
                    project_code: $("#assign_project").val()
                  }) ,

            success: function(data){
              var access  = 0;
              var id      = data.id;
              var role      = data.role;
              access    = data.access;
              $('#ac').val(id);
              $("#assign_project_role").val(role);

                $('#access_form input[type="checkbox"]').each(function(){
                  $(this).prop('checked', false);
                    // alert(access  & parseInt($(this).attr('id')))
                  if((access & parseInt($(this).attr('id'))) == parseInt($(this).attr('id')) ) {
                    $(this).prop('checked', true);
                  }
              })

            } 
          });     
        };
        })                    
    })
 
    $('select#assign_project').change(function(){
      // alert($(this).val());
      // alert($('#user_id').val());
          $.ajax({
            async: "false",
            dataType: "json",
            type: "POST",
            url: "load_privs.php",
            data: ({
                    user_id: $("#user_id").val(),  
                    project_code: $("#assign_project").val()
                  }) ,

            success: function(data){
              var access  = 0;
              var id      = data.id;
              var role      = data.role;
              access    = data.access;
              $('#ac').val(id);
              $("#assign_project_role").val(role);

                $('#access_form input[type="checkbox"]').each(function(){
                  $(this).prop('checked', false);
                    // alert(access  & parseInt($(this).attr('id')))
                  if((access & parseInt($(this).attr('id'))) == parseInt($(this).attr('id')) ) {
                    $(this).prop('checked', true);
                  }
              })

            } 
          });          
    })

 $('select#assign_project_role').change(function(){
      var access  = 0;
    
     access = $('option:selected',this).attr('access');
        $('#access_form input[type="checkbox"]').each(function(){
          $(this).prop('checked', false);
            // alert(access  & parseInt($(this).attr('id')))
          if((access & parseInt($(this).attr('id'))) == parseInt($(this).attr('id')) ) {
            $(this).prop('checked', true);
          }
      })

 });
    $('select#assign_project').change(function(){
        var project_code = $(this).val();
        var client = project_code.substring(0,(project_code.length-2));
        $( 'select#assign_client').load('../../../lookup/client.php?selected='+client, function() {  })    
        // $( 'select#inventory_machine').load('../lookup/machine.php?selected='+project_code, function() {  })    
    })
  $('#event_all_day').change(function(){
      if($(this).is(':checked')) {
         $(this).val('true')
      } else {
          $(this).val('false')
      }
      // alert($(this).val())
  });

   $('#btn_assign_project').click(function(){
    var valid = true;
    // var role = "";
    // if($('#assign_admin').is(':checked')) role = role + "1,";
    // if($('#assign_manager').is(':checked')) role = role + "2,";
    // if($('#assign_engineer').is(':checked')) role = role + "3,";
    // var lastComma = role.lastIndexOf(",")
    // var role = role.substring(0, lastComma);    
        if($("#assign_project").val() == ""){alert('Opps!! Project should not be left empty.');valid=false;}
        else if($("#assign_project_role").val()  ==""){alert('Opss!! Role should not be left empty.');valid=false;}
    var access = 0;

      $('#access_form input').each(function(){
        if($(this).is(':checked')){
          access = access + parseInt($(this).attr('id'));
        }
      })
          // alert (access);

        if(valid){
          $.ajax({
            async: "false",
            type: "POST",
            url: "save.php",
            data: ({
                    id: $("#ac").val(),
                    user_id: $("#user_id").val(),  
                    client_code: $("#assign_client").val(),                  
                    project_code: $("#assign_project").val(),
                    role:  $("#assign_project_role").val(),
                    access : access
                  }) ,

            success: function(data){
              // alert(data)
              if(data=="SAVED"){ 
                alert('Information saved successfully.')
                $('#role_list').load('role_list.php?user_id='+$('#user_id').val(), function() {  })    

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
    $('#btn_save_access').click(function(){
    // var access = 0;

    //   $('#access_form input').each(function(){
    //     if($(this).is(':checked')){
    //       access = access + parseInt($(this).attr('id'));
    //     }
    //   })
    //       alert (access);

          // $.ajax({
          //   async: "false",
          //   type: "POST",
          //   url: "save.php",
          //   data: ({
          //           user_id: $("#user_id").val(),                    
          //           access: access
          //         }) ,

          //   success: function(data){
          //     // alert(data)
          //     if(data=="SAVED"){ 
          //       alert('Information saved successfully.')
          //       //location.reload();    
          //     }

          //     else{//true
          //           alert('Unable to save information.')
          //     }
          //   } 
          // }); 
    })

    $('#btn_cancel_access').click(function(){
      url = "../../../config/user/view.php?user_id=" + $('#user_id').val();
      window.location.replace(url);
    })

    </script>
<?php
}else{
include ("../../../nav/access_denied.php");
}
include ("../../../nav/footer.php");
?>
