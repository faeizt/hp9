<?php
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "incident";
include ("../nav/header.php");
if ($access_control == "true") {
$role =  $_SESSION['usertype'];
?>
    <link href="../css/application.css" rel="stylesheet">
    <link href="../jquery-ui-1.10.3/css/flick/jquery-ui.css"rel="stylesheet" >
    <script src="../jquery-ui-1.10.3/js/jquery-ui.js"></script>    
    <script type="text/javascript" src="../js/jquery-ui-timepicker-addon.js"></script>

<?php
      $PAC  = 0;
      include '../DB.php'; //DB Connection String

      if(isset($_GET['app_no'])){
        $case_id     =   htmlspecialchars(trim($_GET['app_no']));
        // var_dump($result_array);
        $len    = strlen($case_id);
        $end  = $len-7;
        $project =  substr($case_id,0,$end);

        foreach ($result_array as $results) {
          // echo $results['project_code'];
          if ($results['project_code'] == $project) {
            $PAC = $results['access'];
          }
        }
        // echo $result_array[2]['project_code']. " " . $result_array[2]['access'] ;
      ?>

      <!-- Submenu Navigation -->
      <?php  if ((($PAC & 1024) == 1024) || (($PAC & 256) == 256) || (($PAC & 512) == 512)){   ?>
      <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header visible-xs">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".submenu-colls">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>   
          <a class="navbar-brand" > <FONT color="3ca6fb">Submenu &nbsp;</FONT></a>

          </div>   
        <div id="myScrollspy" class="collapse navbar-collapse  submenu-colls">
          <ul class="nav navbar-nav-thin navbar-nav-leftborder-light vert-menu-border">
            <?php  if (($PAC & 512) == 512){   ?><li id="update_status"><a href="#"><span class="glyphicon glyphicon-share-alt"></span> Update Status</a></li><?php  }?>
            <?php  if (($PAC & 256) == 256){   ?><li id="edit_case"><a href="update/?app_no=<?=$case_id?>"><span class="glyphicon glyphicon-pencil"></span> Edit Details</a></li><?php  }?>
            <?php  if (($PAC & 1024) == 1024){ ?><li id="assign_engineer"><a href="#"><span class="glyphicon glyphicon-user"></span> Assign Engineer</a></li><?php  }?>
            <?php  if (($PAC & 1024) == 1024){ ?><li id="email"><a href="#"><span class="glyphicon glyphicon-envelope"></span> Email </a></li><?php  }?>
            <?php  if (($PAC & 1024) == 1024){ ?><li id="remove"><a href="#"><span class="glyphicon glyphicon-trash"></span> Remove </a></li><?php  }?>
          </ul>          
        </div><!--/.nav-collapse -->
      </nav><!--/.navbar-default -->
      <?php
    }
    ?>
      <!-- end of Submenu -->
      <div id="page-wrapper" >
          <div class="col-lg-12">
            <h1>Incident Details <small> Information of an incident in detail</small></h1>
            <ol class="breadcrumb">
              <li class=""><a href="index.php"><i class="icon-tag"></i> Incident</a></li>
              <li class="active"><i class="icon-info-sign"></i> <?=$_GET['app_no']?></li>
              
            </ol>
          </div>
<?php
$sqlquery = "SELECT cases.state,cases.case_id case_id,IF(LENGTH(cases.case_id)>5,SUBSTR(cases.case_id,-7,7),cases.case_id) caseid,project.project_code, info, caller, contact, ".
            "title, ".
            "cases.project_code,cases.sts,cases.client_code,cases.site_id,via,via.code_name as viaDesc, cases.sla , ".
            "servType,type.code_name as typeDesc, cat, cat.code_name as catDesc,item,flag flag_id,cases.product, ".
            "remarks,audit_log,caller,contact,info, resolution,  ".
            "client.acronym acronym ,  ".
            "client_site.site_name,   ".
            "open_by, recurrence, ".
            "getDateDiff(UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(open_date)) dur, ".
            "open_date as x, ".
            "DATE_FORMAT(open_date,'%d/%m/%y %H:%i') open_date, ".
            "DATE_FORMAT(close_date,'%d/%m/%y %H:%i') close_date, ".
            "DATE_FORMAT( open_date,' %d %b %Y') DATE, ".
            "DATE_FORMAT( open_date,'%h:%i %p') TIME, ".
            "sts.code_name status, ". 
            "flag.code_name flag, ".
            "cases.site_name, ".
            "CONCAT(addr1,'\n',addr2,'\n',postcode,' ',city,'\n',statename) address, ".
            "asset, problem,concat(product.product_type,' ',brand,' ',model) machine,sn,engineer,open_by, assign1.user_name user_name ".
            "FROM casesaddr  cases  ".
            "LEFT JOIN (SELECT * FROM (SELECT case_id,sys_users.NAME user_name FROM assignment LEFT JOIN sys_users ON assignment.user_id= sys_users.user_id ORDER BY assign_date DESC) AS assign GROUP BY case_id) AS assign1 ON cases.case_id = assign1.case_id  ".
            "LEFT JOIN  project ON cases.project_code = project.project_code ".
            "LEFT JOIN  product ON cases.product= product.product_id  ".
            "LEFT JOIN  client ON cases.client_code = client.client_code  ".
            "LEFT JOIN  client_site ON cases.site_id = client_site.site_id  ".
            "LEFT JOIN  code_definition sts ON   cases.sts  = sts.CODE AND sts.code_cat='casestatus'  ".
            "LEFT JOIN  code_definition type ON   cases.servType  = type.CODE AND type.code_cat='servicetyp'  ".
            "LEFT JOIN  code_definition cat ON   cases.cat  = cat.CODE AND cat.code_cat='servicecat'  ".            
            "LEFT JOIN  code_definition via ON   cases.via  = via.CODE AND via.code_cat='casevia'  ".            
            "LEFT JOIN  code_definition  flag ON  cases.flag = flag.CODE AND flag.code_cat='flag'  ".
            "LEFT JOIN  code_definition  item ON  cases.item= item.CODE AND item.code_cat='item'  ".
            "where cases.case_id = '$case_id'; "  ;      
            // echo $sqlquery;
        $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row        =   mysqli_fetch_array( $result );
      }
      ?>
      <input type="hidden" id="case_id" value="<?php  if(isset($case_id))echo $case_id;?>">      
      <div class="col-lg-8" id="incident">
          <div class="info"  >
            <span class="name"><i class="icon-wrench"></i>
              <strong class="indent"><?=$row['title']?></strong>
            </span>           
          <div class="content shadow" style="margin-bottom:20px">
            <blockquote style="padding:20px"><?php  echo nl2br($row['problem'])?></blockquote>
            <div class="content"  style="float:right; margin-top:5px" >  <span class="time"><i class="icon-time"></i> <?=$row['dur']?></span> </div>
            <div class="" style="float:left;border:1px solid #f5f5f5;padding:5px; margin-top:5px" >              <span class="label label-info">Incident ID</span> <?=$row['case_id']?>           </div>
          </div> 
          </div>

          <div id="div_incident_status"></div>
          <div class="" style="clear:both;padding:10px;margin-top: 20px;">
              <b>Supporting Evidence </b>
<?php

                  $dir_query = "SELECT * FROM evidence where case_id='$case_id'"; 
                  $dir_result = mysqli_query($con,$dir_query) or die(mysqli_error($con));
                  $dir_num  = mysqli_num_rows($dir_result);
                  $i = 1;
                  if($dir_num>0){
                    while($dir_row = mysqli_fetch_array($dir_result)){?> 
            <div class="" style="border:1px solid #f5f5f5;padding:5px"  >              
              <a href="../images/uploads/<?=$dir_row['name']?>" target="_blank"><i class="icon-paper-clip"></i> <?=$dir_row['name']?></a><span class="label label-info" style="float:right"><?=number_format($dir_row['size']/1024)?> KB</span></div>
              <?php
                            $i++;
            }}?>                            <link href="../css/dropzone.css" type="text/css" rel="stylesheet" />
              <script src="../js/dropzone.min.js"></script>
              <form action="upload.php" class="dropzone"><input type="hidden" name="case_id" value="<?=$row['case_id']?>"/></form>

          </div>    
          <div id="Comments"></div>
          </div>  

      </div>
      <div class="col-lg-4">

          <style type="text/css">
            .actions li {
            display: inline;
            border-right: 1px solid #d0dde9;
            padding: 5px 6px 0px 3px;
            }
            .actions li.last {
            border: 0 none;
            }
                        @media (min-width: 1000px) {
              .some_class{width:500px;}
            }
            @media (max-width: 1000px) {
              .some_class{width:500px;}
            }
            @media (max-width: 800px) {
              .some_class{width:500px;}
            }
            @media (max-width: 500px) {
              .some_class{width:300px;}
            }
            #menu .nav > li{
              padding-left: 30px;
              color: #ADD0EE;
            }
            #menu .nav > li > a {
            position: relative;
            display: block;
            padding: 10px 5px;
            border-left: 1px solid rgb(233, 233, 233);

            }

            #menu.navbar-collapse {
            padding-right: 0px;
            padding-left: 0px;   
            }     
            #menu{
              background-color: #f8f8f8;  
              border-color: #e7e7e7;
            border: 1px solid rgb(233, 233, 233);  
            }    
          </style>
        <div class="modal fade" id="modal_assign_engineer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> Assign Engineer</h4>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_assign_engineer" class="btn btn-primary">Assign</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->          
        <div class="modal fade" id="modal_update_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-tag"></span> Update Status</h4>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer" style="clear:both">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_update_status" class="btn btn-primary">Update</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->           
        <div class="modal fade" id="modal_email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-envelope"></span> Email Incident</h4>
              </div>
              <div class="modal-body">Please enter email : <textarea id="email_list" style="width:400px" placeholder="Enter email here..."></textarea></div>
              <div class="modal-footer" style="clear:both">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_email" class="btn btn-primary">Send</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="modal_remove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Remove Incident</h4>
              </div>
              <div class="modal-body">Please note that this action cannot be rollback. Are you sure to remove the incident? </div>
              <div class="modal-footer" style="clear:both">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_remove" class="btn btn-danger">Remove</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->                
<!--         <div id="menu" class="navbar-inverse   ">
          <ul class="nav navbar-inverse ">
            <li id="update_status"><a href="#"><span class="glyphicon glyphicon-share-alt"></span> Update Status</a></li>
            <li id="edit_case"><a href="update/?app_no=<?=$case_id?>"><span class="glyphicon glyphicon-pencil"></span> Make changes to Incident </a></li>
            <li id="assign_engineer"><a href="#"><span class="glyphicon glyphicon-user"></span> Assign Engineer</a></li>
          </ul>          
        </div>   -->        
<!--           <div class="info" style="margin-bottom:10px">
            <span class="name">
             <strong class="indent">
             <ul class="actions" style="padding-left: 0px;margin-bottom: 0px;">
              <li><i class="table-edit"></i><button type="button" class="btn btn-primary btn-xs">Move Project</button></li>
              <li><i class="table-settings"></i><button type="button" class="btn btn-info btn-xs">Assign Engineer</button></li>
              <li class="last"><i class="table-delete"><button type="button" class="btn btn-warning btn-xs">Edit</button></i></li>
            </ul></strong>
            </span>

          </div> -->
      </div>      
      <div class="col-lg-4" >

          <table id="case" class="table table-hover shadow" style="border-bottom: 3px solid #DDDDDD;">
            <tbody>
              <tr><td style="width:36%"><i class="icon-ok-circle"></i> Status</td><td><?=$row['status']?></td></tr>
              <tr><td><i class="icon-user"></i> Engineer</td><td id="engineer_name"><?=$row['user_name']?></td></tr>
              <!-- <tr><td><i class="icon-legal"></i> SLA</td><td>Severity level <?=$row['flag']?></td></tr> -->
              <tr><td><i class="icon-calendar"></i> Open Date</td><td><?=$row['open_date']?></td></tr>
            <tr><td><i class="fa fa-ticket"></i> Serial Number</td><td><?=$row['sn']?></td></tr>
            <tr><td><i class="fa fa-desktop"></i> Machine Type</td><td><?=$row['machine']?></td></tr>
            <tr><td><i class="fa fa-ticket"></i> Service Type</td><td><?=$row['typeDesc']?></td></tr>    
            <tr><td><i class="fa fa-ticket"></i> Category</td><td><?=$row['catDesc']?></td></tr>              
              <!-- <tr><td><i class="icon-retweet"></i> Recurrence</td><td><?php  if ($row['recurrence']=="") {
                echo "No";
              }else{echo $row['recurrence'];}?></td></tr> -->
              <tr><td><i class="icon-map-marker"></i> Site Name</td><td><?=$row['site_name']?></td></tr>
              <tr><td><i class="icon-envelope"></i> Site Address</td><td><?php  echo nl2br($row['address'])?></td></tr>
              <tr><td><span class="glyphicon glyphicon-user"></span> Customer Name</td><td><?=$row['caller']?></td></tr>
              <tr><td><span class="glyphicon glyphicon-earphone"></span> Customer Contact</td><td><?=$row['contact']?></td></tr>
              <tr><td><span class="glyphicon glyphicon-send"></span> Customer Email</td><td><?=nl2br($row['info'])?></td></tr>
            </tbody>
          </table>
<script type="text/javascript">

  $('#btn_update_status').click(function(){
    if ($('#status_list').val()==1) {if ($('#status_onsite_time').val()=="") {alert('Oppss!! Onsite time should not be left empty.');return false;}};
    if ($('#status_list').val()==3) {if ($('#status_remarks').val()=="") {alert('Oppss!! Remarks should not be left empty.');return false;}};
    if ($('#status_list').val()==4 || $('#status_list').val()==5) {
	  // alert(($('#status_resolution').val()));	
   //    alert(($('#status_resolution').val()==""));
      if ($('#status_onsite_time').val()=="") 		{alert('Oppss!! Onsite time should not be left empty.');return false;}
      else if ($('#status_resolve_time').val()=="") {alert('Oppss!! Resolve time should not be left empty.');return false;}
      else if ($('#status_resolution').val()=="") 	{alert('Oppss!! Incident resolution should not be left empty.');return false;}
    };
 // alert($("#status_resolve_time").val() )    
    $.ajax({
      async: "false",
      type: "POST",
      url: "update_status/update.php",
      data: ({
              case_id   : $('#case_id').val(),
              status    : $('#status_list').val(),
              onsite    : $("#status_onsite_time").val() ,
              resolve   : $("#status_resolve_time").val() ,
              remarks   : $("#status_remarks").val() ,
              reso_type: $("#status_resolution_type").val() ,
              resolution: $("#status_resolution").val() 
            }) ,

      success: function(auth){
        // alert(auth)
        if(auth=="false"){ 
          alert('Oppss!! Unable to update status.');
        }
        else{
		  $('#div_incident_status').load('incident_status.php?case_id='+$('#case_id').val(),function(){  });        	
          alert('This incident status is now set to ' +  $("#status_list option:selected").text() );
          $('#modal_update_status').modal('hide');

        }
      }
    });    

  });
  $('#btn_remove').click(function(){
    $.ajax({
      async: "false",
      type: "POST",
      url: "remove/remove.php",
      data: ({
              case_id   : $('#case_id').val(),
            }) ,

      success: function(auth){
        // alert(auth)
        if(auth=="true"){ 
          alert('Record successfully removed.');
          $('#modal_remove').modal('hide');
          window.location.href="index.php";

        }
        else{
          alert('Oppss!!, unable to process your request at the moment.');
          $('#modal_remove').modal('hide');

        }
      }
    });    
  });
  $('#btn_email').click(function(){
     $('#modal_email').modal('hide');

    $.ajax({
      async: "false",
      type: "POST",
      url: "email/email.php",
      data: ({
              case_id   : $('#case_id').val(),
              email     : $("#email_list").val() 
            }) ,

      success: function(auth){
        alert(auth);
      //   if(auth=="false"){ 
      //     alert('Oppss!! Unable to update status.');
      //   }
      //   else{
      // $('#div_incident_status').load('incident_status.php?case_id='+$('#case_id').val(),function(){  });          
      //     alert('This incident status is now set to ' +  $("#status_list option:selected").text() );
      //     $('#modal_update_status').modal('hide');

      //   }
      }
    });    

  });
  $('#div_incident_status').load('incident_status.php?case_id='+$('#case_id').val(),function(){  });
  $('#modal_update_status .modal-body').load('update_status/?case_id='+$('#case_id').val(),function(){  });
  $('#modal_assign_engineer .modal-body').load('assign_engineer/',function(){  });
  // $('#modal_email .modal-body').load('email/?case_id='+$('#case_id').val(),function(){  });
  // $('#modal_remove .modal-body').load('remove/?case_id='+$('#case_id').val(),function(){  });

  $('#Comments').load('comments.php?case_id='+$('#case_id').val(),function(){  });

  $('#edit_case').click(function() {
     $('#case .editable').editable('toggleDisabled');
     $('#incident .editable').editable('toggleDisabled');

  });
  $('#assign_engineer').click(function() {
    $('#modal_assign_engineer').modal('show');
  });  
  $('#update_status').click(function() {
    $('#modal_update_status').modal('show');
  });  
  $('#remove').click(function() {
    $('#modal_remove').modal('show');
  });  
  $('#email').click(function() {
    $('#modal_email').modal('show');
  });  

  $(document).ready(function() {
      //toggle `popup` / `inline` mode
      $.fn.editable.defaults.mode = 'inline';     
      $.fn.editable.defaults.disabled = 'true'; 

      $('#title').editable({
          type: 'text',
          title: 'Enter problem title',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });      
      $('#problem').editable({
          type: 'textarea',
          title: 'Enter problem description',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php',
          inputclass: 'some_class'
          
      });      
      $('#status').editable({
          type: 'text',
          title: 'Choose status',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });      
      // $('#engineer').editable({
      //     type: 'text',
      //     title: 'Choose Engineer',
      //     placement: 'right',         
      //     pk: $('#app_no').val(),
      //     url: 'app_update.php'
          
      // });      
      $('#flag').editable({
          type: 'text',
          title: 'Choose severity',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });      
      $('#open_date').editable({
          type: 'text',
          title: 'Open date',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });         
      $('#recurrence').editable({
          type: 'text',
          title: 'Enter previous case id',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });        
      $('#site_id').editable({
          type: 'text',
          title: 'Enter site name',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });        
      $('#caller').editable({
          type: 'text',
          title: 'Enter contact person',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });        
      $('#contact').editable({
          type: 'text',
          title: 'Enter contact no',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });        
      $('#info').editable({
          type: 'text',
          title: 'Enter additional contact info',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });        
  });  
</script>
        
<?php
}else{
include ("../nav/access_denied.php");
}
include ("../nav/footer.php");
?>