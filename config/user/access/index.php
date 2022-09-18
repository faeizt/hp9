<?php
session_start();
$_SESSION['nav_level'] = "3";
$_SESSION['nav_title'] = "config";
include ("../../../nav/header.php");
if ($access_control2 == "true") {
?>
      <input type="hidden" id="rpt_page" value="1">
      <input type="hidden" id="srcht" value="">
      <input type="hidden" id="fltr2" value="">
      <input type="hidden" id="fltrt1" value="<?=$_SESSION['def_project']?>">
      <input type="hidden" id="fltrt2" value="">
      <input type="hidden" id="fltrt3" value="">
      <input type="hidden" id="fltrt4" value="">
      <input type="hidden" id="fltrt5" value="">
      <input type="hidden" id="fltrt6" value="">      
      <input type="hidden" id="srt" value="">                
      <?php
      include '../../../DB.php';

      if(isset($_GET['user_id'])){
        $user_id          =   htmlspecialchars(trim($_GET['user_id']));
        
                $user_access  = 0;      
                $user_access2 = 0;             
                $user_access3 = 0;
                $sqlquery = "SELECT * FROM sys_users where user_id = '$user_id'";
                $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
                $row =   mysqli_fetch_array( $result );
                $user_access  = intval($row['access']);
                $user_access2 = intval($row['access2']);
                $user_access3 = intval($row['access3']);        
   
      ?>
      <div id="page-wrapper">
                  <div class="col-lg-12">
                    <h1>Access Control <small>Access Mapping</small></h1>
                    <ol class="breadcrumb">
                      <li ><a href="../../../config"><i class="icon-cogs"></i> Configuration</a></li>
                      <li class=""><a href="../../../config/user"><i class="icon-fire"></i> User</a></li>
                      <li class=""><a href="../../../config/user/view.php?user_id=<?=$user_id?>"><i class="icon-user"></i> <?=$row['name']?></a></li>
                      <li class="active"><i class="icon-briefcase"></i> Access Control</li>
                    </ol>
                  </div>
                </div><!-- /.row -->
                <?php

                $sqlquery = "SELECT * FROM access WHERE type='1- Page' and description IS NOT NULL order by id";
                $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query

                $sqlquery2 = "SELECT * FROM access WHERE type='2- Setting Page' and description IS NOT NULL order by id";
                $result2 = mysqli_query($con,$sqlquery2) or die("sql= ". $sqlquery2);          //query

                $sqlquery3 = "SELECT * FROM access WHERE type='Button' and description IS NOT NULL order by id";
                $result3 = mysqli_query($con,$sqlquery3) or die("sql= ". $sqlquery3);          //query
                ?>

        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="role" value="<?php if(isset($row['role_id']))echo $row['role_id'];?>">     
        <input type="hidden" id="user_id" value="<?php if(isset($_GET['user_id']))echo $_GET['user_id'];?>">     
        <div class="col-md-9  with-sidebar">
<div class="row">
          <div class="col-lg-6" id="access_form">
              <label class=" "><i class="fa fa-star "></i> Page Access</label>
                    <input type="hidden" id="assign_access">

                    <?php
                    $i=0;
                    $access_id=0;
                    while($row = mysqli_fetch_array($result)){
                    $i++;
                    $access_id = intval($row['access_id']);
                    ?>

                    <p class="help-block" style="padding-left: 20px"><input type="checkbox" id="<?=$access_id?>" <?php if (($user_access & $access_id) == $access_id) { echo 'checked'; } ?>> <?=$row['description']?></p>

                    <?}?>

                </div>
          <div class="col-lg-6" id="access_form2">
                <label ><i class="fa fa-star "></i> Setting Access</label>
                    <input type="hidden" id="assign_access2">

                    <?php
                    $i2=0;
                    $access_id2=0;
                    while($row2 = mysqli_fetch_array($result2)){
                    $i2++;
                    $access_id2 = intval($row2['access_id']);
                    ?>

                    <p class="help-block"><input type="checkbox" id="<?=$access_id2?>" <?php if (($user_access2 & $access_id2) == $access_id2) { echo 'checked'; } ?>> <?=$row2['description']?></p>

                    <?}?>


          </div>
        </div>
                                

            <div class="" style="text-align:center;margin:20px;width:100%"> 
              <a id="btn_save_access" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Assign</a>  
              <a id="btn_cancel_access" class="btn btn-default">Cancel</a>
            </div>

          </div>

        <div class="col-md-3 form-sidebar">
            <div class="alert alert-info">
                <span style="font-size:20px;font-weight:bold"><i class="icon-lightbulb pull-left"></i></span>
                Please make sure user being given the correct role and access.
            </div>    
            <p>Related links</p><hr><p></p>
            <p>
                </p><ul>
                    <li><a href="../assign_project?user_id=<?=$user_id?>">Project Access Control</a></li>
                </ul>
            <p></p>
        </div>

      </div><!-- /#page-wrapper -->
<?php
      }
      ?>

    <script type="text/javascript">


    $('#btn_save_access').click(function(){
    var access  = 0;
    var access2 = 0;
    var access3 = 0;

      $('#access_form input').each(function(){
        if($(this).is(':checked')){
          access = access + parseInt($(this).attr('id'));
        }
      })

      $('#access_form2 input').each(function(){
        if($(this).is(':checked')){
          access2 = access2 + parseInt($(this).attr('id'));
        }
      })

      $('#access_form3 input').each(function(){
        if($(this).is(':checked')){
          access3 = access3 + parseInt($(this).attr('id'));
        }
      })
          //alert (access);

          $.ajax({
            async: "false",
            type: "POST",
            url: "save.php",
            data: ({
                    user_id: $("#user_id").val(),                    
                    access: access,
                    access2: access2,
                    access3: access3
                  }) ,

            success: function(data){
              // alert(data)
              if(data=="SAVED"){ 
                alert('Information saved successfully.')
                //location.reload();    
              }

              else{//true
                    alert('Unable to save information.')
              }
            } 
          }); 
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