<?php
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "incident";
include ("../../nav/header.php");
if ($access_control == "true") {
?>
    <link href="../../css/application.css" rel="stylesheet">
    <script src='../../js/jquery.autosize.js'></script>


      <!-- end of Submenu -->
      <div id="page-wrapper" >
          <div class="col-lg-12">
            <h1>Incident Details <small> Information of an incident in detail</small></h1>
            <ol class="breadcrumb">
              <li><a href=".."><i class="icon-dashboard"></i> Dashboard</a></li>
              <li class=""><a href="../index.php"><i class="icon-tag"></i> Incident</a></li>
              <li ><a href="../view.php?app_no=<?=$_GET['app_no']?>"><i class="icon-info-sign"></i> <?=$_GET['app_no']?></a></li>
              <li class="active"><i class="icon-info-pencil"></i> Edit</li>
              
            </ol>
          </div>
<?php
      include '../../DB.php'; //DB Connection String

      if(isset($_GET['app_no'])){
        $case_id     =   htmlspecialchars(trim($_GET['app_no']));
$sqlquery = "SELECT cases.state,cases.case_id case_id,IF(LENGTH(cases.case_id)>5,SUBSTR(cases.case_id,-7,7),cases.case_id) caseid,project.project_code, info, caller, contact, ".
            "title, ".
            "cases.project_code,cases.sts,cases.client_code,cases.site_id,cases.addr_id,via,via.code_name as viaDesc, cases.sla , ".
            "servType,type.code_name as typeDesc, cat, cat.code_name as catDesc,item,flag flag_id,cases.product, ".
            "remarks,audit_log,caller,contact,info, resolution,  ".
            "client.acronym acronym ,  ".
            "client_site.site_name,   ".
            "open_by, recurrence, ".
            "getDateDiff(UNIX_TIMESTAMP(ifnull(close_date,now())) - UNIX_TIMESTAMP(open_date)) dur, ".
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
            "where cases.case_id = '$case_id'; "  ;      // echo $sqlquery;
        $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row        =   mysqli_fetch_array( $result );

      }
      ?>
      <input type="hidden" id="case_id" value="<?php if(isset($case_id))echo $case_id;?>">      
      <input type="hidden" id="status" value="<?php if(isset($row['sts']))echo $row['sts'];?>">   
      <input type="hidden" id="project" value="<?php if(isset($row['project_code']))echo $row['project_code'];?>">   
      <input type="hidden" id="service_type" value="<?php if(isset($row['servType'])){echo $row['servType'];}?>">
      <input type="hidden" id="category" value="<?php if(isset($row['cat'])){echo $row['cat'];}?>">
      <input type="hidden" id="machine" value="<?php if(isset($row['product'])){echo $row['product'];}?>">
      <input type="hidden" id="severity" value="<?php if(isset($row['flag'])){echo $row['flag_id'];}?>">
      <input type="hidden" id="sla" value="<?php if(isset($row['sla']))echo $row['sla']?>">      
      <input type="hidden" id="report_channel" value="<?php if(isset($row['via'])){echo $row['via'];}?>">
      <input type="hidden" id="edit_site_id" value="<?php if(isset($row['site_id'])){echo $row['site_id'];}?>">
      <input type="hidden" id="edit_addr_id" value="<?php if(isset($row['addr_id'])){echo $row['addr_id'];}?>">
      <input type="hidden" id="edit_sla" value="<?php if(isset($row['sla'])){echo $row['sla'];}?>">
      

      <div class="col-lg-8 form-horizontal" id="incident">
          <div class="info" style="background: ghostwhite;" >
                  <div class="input-group" style="margin-bottom:2px">
                    <span class="input-group-addon"><i class="icon-wrench"></i></span>
                    <input id="edit_title" style="background-color: transparent;" name="full-name" type="text" placeholder="Site Name" value="<?=$row['title']?>" 
                    class="form-control">                  
                  </div>      
          </div>
          <div class="content shadow" style="margin-bottom:20px">
            <div class="form-group" style="margin-bottom:0px">

                <div class="col-sm-12">
                    <textarea id="edit_description" class="form-control" style="height:100px;border-bottom: 0px solid #cccccc;"><?echo ($row['problem'])?></textarea>
                </div>
            </div>          
            <div class="content"  style="float:right; margin-top:5px" >  <span class="time"><i class="icon-time"></i> <?=$row['dur']?></span> </div>
            <div class="" style="float:left;border:1px solid #f5f5f5;padding:5px; margin-top:5px" >              <span class="label label-info">Incident ID</span> <?=$row['case_id']?>           </div>
          </div>   

            <div class="form-group" style="clear:both;text-align:center;margin-top:60px">
                <div class="col-sm-5">
                  <div class="input-group" style="margin-bottom:2px">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
                    <input type="text" id ="edit_site_name" class="form-control" placeholder="Site Name" value="<?=$row['site_name']?>">
                  </div>
                  <div class="input-group" style="margin-bottom:2px">
                    <span class="input-group-addon"><i class="fa fa-fw"></i></span>
                     <select id="edit_report_channel" class="form-control"></select>
                  </div>                  
                </div>
                <div class="col-sm-7">
                  <div class="input-group" style="margin-bottom:2px">
                    <span class="input-group-addon"><i class="icon-envelope"></i></span>
                    <textarea name="info" id="edit_site_address" class="form-control" style="height:85px;margin-top:5px" placeholder="Client Site Address"><?echo ($row['address'])?></textarea>                  </div>                    
                </div>    


            </div>            
            <div class="form-group" style="clear:both;text-align:center;margin-top:0px">
                <div class="col-sm-5">

                  <div class="input-group" style="margin-bottom:2px">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" id="edit_contact_person" class="form-control" placeholder="Customer Name" value="<?=$row['caller']?>">
                  </div>
                  <div class="input-group" style="margin-bottom:2px">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
                    <input type="text" id="edit_contact_no" class="form-control" placeholder="Customer Contact" value="<?=$row['contact']?>">
                  </div>
                </div>
                <div class="col-sm-7">
                  <div class="input-group" style="margin-bottom:2px">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-plus"></span></span>
                    <textarea name="info" id="edit_add_info" class="form-control" style="height:65px;margin-top:5px" placeholder="Customer Email"><?echo ($row['info'])?></textarea>                  </div>                    

                </div>    


            </div>     

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
              <div class="modal-body">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_assign_engineer" class="btn btn-primary">Assign</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->          
   
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
            <!-- <tr><td><i class="icon-legal"></i> Severity level</td><td> <select id="edit_severity" class="form-control"></select></td></tr> -->
            <!-- <tr><td><i class="icon-retweet"></i> Recurrence</td><td><input type="text" value="<?=$row['recurrence']?>" id="edit_recurrence" class="form-control " placeholder="Previous incident ID"></td></tr> -->
            <tr><td><i class="fa fa-ticket"></i> Serial Number</td><td><input type="text" value="<?=$row['sn']?>" id="edit_sn" class="form-control " placeholder="Serial Number"></td></tr>
            <tr><td><i class="fa fa-desktop"></i> Machine Type</td><td><select id="edit_machine_type" class="form-control" / ></td></tr>
            <tr><td><i class="fa  fa-stethoscope"></i> Service Type</td><td> <select id="edit_service_type" class="form-control" / ></td></tr>
            <tr><td><i class="fa  fa-puzzle-piece"></i> Category</td><td> <select id="edit_category" class="form-control"></select></td></tr>

            <tr><td><i class="icon-user"></i> Engineer</td><td id="engineer_name"><?=$row['user_name']?></td></tr>
            <tr><td style="width:36%"><i class="icon-ok-circle"></i> Status</td><td><?=$row['status']?><!--  <select id="edit_status" class="form-control"></select> --></td></tr>
            <tr><td><i class="icon-calendar"></i> Open Date</td><td><?=$row['open_date']?></td></tr>
          </tbody>
        </table>
       <button type="button" id="btn_edit_save" class="btn btn-primary btn-lg btn-block">Save Changes</button>
      <button type="button"  id="btn_edit_cancel" class="btn btn-default btn-lg btn-block">Cancel</button>

      </div>
<script type="text/javascript">
  $('select#edit_service_type').load('../../lookup/service_type.php?selected='+$('#service_type').val(), function() {  })    
  $('select#edit_category').load('../../lookup/category.php?selected='+$('#category').val(), function() {  })    
  $('select#edit_report_channel').load('../../lookup/report_channel.php?selected='+$('#report_channel').val(), function() {  })    
  $('select#edit_status').load('../../lookup/status.php?selected='+$('#status').val(), function() {  })    
  $('select#edit_severity').load('../../lookup/severity.php?selected='+$('#severity').val()+'&sla='+$('#sla').val(), function() {  }) 
  $('select#edit_machine_type').load('../../lookup/machine.php?project='+$('#project').val()+'&selected='+$('#machine').val(), function() {  })    
   
  $('#btn_edit_save').click(function(){
    // alert('Are you sure all information are correct?');
    // alert($("#edit_site_id").val());
    // alert($("#edit_addr_id").val());
    // alert($("#edit_report_channel").val());
    // alert($("#edit_contact_person").val());
    // alert($("#edit_contact_no").val());
    // alert($("#edit_add_info").val());
    // alert($("#edit_title").val());
    // alert($("#edit_description").val());
    // alert($("#edit_sn").val());
    // alert($("#edit_asset").val());
    // alert($("#edit_service_type").val());    
    // alert($("#edit_category").val());
    // alert($("#edit_sla").val());
    // alert($("#edit_severity").val());
    // alert($("#edit_recurrence").val());
    var valid = false;
      $.ajax({
        async: "false",
        type: "POST",
        url: "save.php",
        data: ({
            case_id         : $("#case_id").val()  ,
            site            : $("#edit_site_id").val()  ,
            address         : $("#edit_addr_id").val()  ,
            report_channel  : $("#edit_report_channel").val()  ,
            contact_person  : $("#edit_contact_person").val()  ,
            contact_no      : $("#edit_contact_no").val()  ,
            add_info        : $("#edit_add_info").val()  ,
            title           : $("#edit_title").val()  ,
            description     : $("#edit_description").val()  ,
            sn              : $("#edit_sn").val()  ,
            asset           : $("#edit_machine_type").val()  ,
            service_type    : $("#edit_service_type").val()  ,
            category        : $("#edit_category").val()  ,
            sla             : $("#edit_sla").val()  ,
            severity        : $("#edit_severity").val()  ,
            recurrence      : $("#edit_recurrence").val()  

              }) ,

        success: function(data){
          if(data=="SAVED"){ 
            alert('Information saved.')
            window.location.replace("../view.php?app_no="+$('#case_id').val());

          }

          else{//true
                valid = false;
                alert('fail')
          }
        } 
      }); 
  });
  $('#btn_edit_cancel').click(function(){
        var msg = '<i class="fa fa-info-circle"></i> Are you sure to cancel editting the incident?';
        var div = $("<div>" + msg + "</div>");
        div.dialog({
            title: "Confirm Cancel",
            modal:true,
            buttons: [
                        {
                            text: "Yes",
                            click: function () {
                              window.location.replace('../view.php?app_no='+$('#case_id').val());
                            }
                        },
                        {
                            text: "No",
                            click: function () {
                                div.dialog("close");
                            }
                        }
                    ]
        });

  });  
  $(function(){
    $('#edit_description').autosize();
  });
  $( "#edit_site_name" ).autocomplete({
      source: function(request, response) {
          $.ajax({
              url: "../../lookup/site.php",
              dataType: "json",
              data: {
                  term: request.term,
                  project_code: $('#project').val()
              },
              success: function(data) {
                  // alert($('#edit_client').val());
                  response(data);
              }
          });
      },          
      minLength: 1,
      select: function( event, ui ) {
          var address = ui.item.addr1+'\n'+ui.item.addr2+'\n'+ui.item.postcode+' '+ui.item.city+'\n'+ui.item.statename;
          $( "#edit_site_address" ).val(address);
          $( "#edit_site_id" ).val(ui.item.desc);
          $( "#edit_addr_id" ).val(ui.item.addr_id);
      }
  });            
  $( "#edit_contact_person" ).autocomplete({
      source: function(request, response) {
          $.ajax({
              url: "../../lookup/contact_person.php",
              dataType: "json",
              data: {
                  term: request.term,
                  project_code: $('#project').val(),
                  site_id: $('#edit_site_id').val()
              },
              success: function(data) {
                  // alert($('#edit_client').val());
                  response(data);
              }
          });
      },          
      minLength: 1,
      select: function( event, ui ) {
          var address = ui.item.addr1+'\n'+ui.item.addr2+'\n'+ui.item.postcode+' '+ui.item.city+'\n'+ui.item.statename;
          var project_code = ui.item.project;
          $( "#edit_contact_no" ).val(ui.item.desc);
          $( "#edit_site_address" ).val(address);
          $( "#edit_site_id" ).val(ui.item.site_id);
          $( "#edit_site_name" ).val(ui.item.site);
          $( "#edit_addr_id" ).val(ui.item.addr_id);
      }
  })
  .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
      .data( "item.autocomplete", item )
      .append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
      .appendTo( ul );
  };      

 
</script>
        
<?php
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>