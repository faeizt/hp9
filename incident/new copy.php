
<?php
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "incident";
include ("../nav/header.php");
if ($access_control == "true") {
?>
    <script src='../js/jquery.autosize.js'></script>
<?php
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
<input type="hidden" id="machine" value="<?if(isset($row['product'])){echo $row['product'];}?>">

      <div id="page-wrapper" >
          <div class="col-lg-12">
            <h1>Incident <small>Keep track of all incidents</small></h1>
            <ol class="breadcrumb">
              <li ><a href="index.php"><i class="icon-folder-close"></i> Indicent</a></li>
              <li class="active"><i class="icon-file-alt"></i> New Incident</li>
            </ol>

          </div>
        <form class="form-horizontal" role="form" style="margin-top:10px">
        <input type="hidden" id="incident_site_id">
        <input type="hidden" id="incident_addr_id">        
        <input type="hidden" id="incident_sla">        
        <div class="col-md-9">

            <div class="form-group">
                <label class=" col-sm-4 control-label">Choose Client</label>
                <div class="col-sm-7">
                    <select id="incident_client" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">                
                <label class=" col-sm-4 control-label">Choose Project</label>
                <div class="col-sm-7">
                    <select id="incident_project" class="form-control" ></select>
                    <p class="help-block"></p>
                </div>                
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Site Name</label>
                <div class="col-sm-7">
                    <input id="incident_site_name" name="full-name" type="text" placeholder="Site Name" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Site Address</label>
                <div class="col-sm-7">
                    <textarea name="info" id="incident_site_address" class="form-control" style="height:100px;margin-top:5px" placeholder="Site Address"></textarea>
                    <p class="help-block"></p>
                </div>           
            </div>            

            <div class="form-group">
                <label class="col-sm-4 control-label">Customer Name</label>
                <div class="col-sm-7">
                    <input id="incident_contact_person" name="full-name" type="text" placeholder="Customer Name" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Customer Contact</label>
                <div class="col-sm-7">
                    <input id="incident_contact_no" name="full-name" type="text" placeholder="Customer Contact" value="" 
                    class="form-control">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Customer Email</label>
                <div class="col-sm-7">
                    <textarea id="incident_add_info" class="form-control" style="margin-top:5px" placeholder="Customer Email"></textarea>
                    <p class="help-block"></p>
                </div>
            </div>         
            <div class="form-group" >
                <label class="col-sm-4 control-label">Report Channel</label>            
                <div class="col-sm-7">
                    <select id="incident_report_channel" class="form-control"></select>
                    <p class="help-block"></p>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-4 control-label">Incident Title</label>
                <div class="col-sm-7  ">
                    <input id="incident_title" name="full-name" type="text" placeholder="Incident Title" value="" class="form-control">
                    <p class="help-block"></p>                
                </div>
            </div>   
            <div class="form-group">
                <label class="col-sm-4 control-label">Incident Description</label>
                <div class="col-sm-7  ">
                    <textarea id="incident_description" class="form-control" style="margin-top:5px" placeholder="Incident Description"></textarea>
                    <p class="help-block"></p>
                </div>
            </div>   
             <div class="form-group">
                <label class="col-sm-4 control-label">Serial Number</label>
                <div class="col-sm-7">
                    <input id="incident_sn" type="text" placeholder="Serial Number" value="" class="form-control UCASE">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-4 control-label">Machine Type</label>
                <div class="col-sm-7">
                   <select id="incident_machine" class="form-control"></select>
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Service Type</label>            
                <div class="col-sm-7">
                    <select id="incident_service_type" class="form-control"></select>
                    <p class="help-block"></p>
                </div>
            </div>    
            <div class="form-group" style="display:none">
                <label class="col-sm-4 control-label">Category</label>            
                <div class="col-sm-7">
                    <select id="incident_category" class="form-control"></select>
                    <p class="help-block"></p>
                </div>
            </div> 
<!--             <div class="form-group">
                <label class="col-sm-4 control-label">Product/Model</label>            
                <div class="col-sm-7">
                    <select id="incident_product" class="form-control"></select>
                    <p class="help-block"></p>
                </div>
            </div>  -->
            <div class="form-group"  style="display:none">
                <label class="col-sm-4 control-label">Severity Level</label>            
                <div class="col-sm-7">
                    <select id="incident_severity" class="form-control"></select>
                    <p class="help-block"></p>
                </div>
            </div>                                                               
            <div class="form-group">
                <label class="col-sm-4 control-label">Recurrence Indicent</label>            
                <div class="col-sm-7">
                    <input type="checkbox" id="incident_recurrence_check" style="margin-top: 10px;"> <label>check me for recurrence incident</label><input type="text" id="incident_recurrence" class="form-control hide" placeholder="Previous incident ID">
                    <p class="help-block"></p>
                </div>
            </div>     
            <div class="" style="text-align:center;margin:20px;width:100%">
                <a id="btn_save_incident" class="btn btn-primary"><i class="fa fa-fw fa-floppy-o"></i> Save</a>  
                <a id="btn_cancel_incident" class="btn btn-default">Cancel</a>
            </div>

        </div>
<div class="col-md-3 form-sidebar">
                    <div class="alert alert-info">
                        <span style="font-size:20px;font-weight:bold"><i class="icon-lightbulb pull-left"></i></span>
                        Please make sure all informations are correct before submitting the incident.
                    </div>                        
                    <p>Supporting documents & evidence can be uploaded after submitting the incident.</p>

                </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">

    $('#incident_add_info').autosize();
    $('#incident_description').autosize();
            $('select#incident_client').load('../lookup/client_filtered.php?selected='+$('#client').val()+'&code=128', function() {  })    
            $('select#incident_project').load('../lookup/project_filtered.php?client='+$('#incident_client').val()+'&selected='+$('#project').val()+'&code=128', function() {  })    
            $('select#incident_report_channel').load('../lookup/report_channel.php?selected='+$('#report_channel').val(), function() {  })    
            $('select#incident_service_type').load('../lookup/service_type.php?selected='+$('#service_type').val(), function() {  })    
            $('select#incident_category').load('../lookup/category.php?selected='+$('#category').val(), function() {  })    
            $('select#incident_product').load('../lookup/product.php?selected='+$('#product').val(), function() {  })    
            $('select#incident_severity').load('../lookup/severity.php?selected='+$('#severity').val(), function() {  })   
            $('select#incident_machine').load('../lookup/machine.php?project=&selected='+$('#machine').val(), function() {  })    
 

            $('select#incident_client').change(function(){
                $('select#incident_project').load('../lookup/project_filtered.php?client='+$('#incident_client').val()+'&selected='+$('#project').val()+'&code=128', function() { 
                $( "#incident_contact_person" ).val('');
                $( "#incident_contact_no" ).val('');
                $( "#incident_site_address" ).val('');
                $( "#incident_site_id" ).val('');
                $( "#incident_site_name" ).val('');
                $( "#incident_addr_id" ).val('');

                var project_code =  $('select#incident_project').val();
                $( 'select#incident_machine').load('../lookup/machine.php?project='+project_code+'&selected=', function() {  })    
                /***start of Lookup SLA***/
                /*************************/

                $.ajax({
                        type: 'GET',
                        url: '../lookup/sla.php',
                        data: ({project:project_code}),
                        dataType: 'html',
                        success: function (sla) {
                            // console.log(data);
                            if (sla != "") {
                                $('#incident_sla').val(sla); //assign sla to input field
                                $('#incident_severity').load('../lookup/severity.php?sla='+sla + '&selected='+$('#severity').val(), function() {    }); 
                                
                            }                               
                        }
                });

               })                    
            })

            $('select#incident_project').change(function(){
                var project_code = $(this).val();
                var client = project_code.substring(0,(project_code.length-2));
                /***start of Lookup SLA***/
                /*************************/

                $.ajax({
                        type: 'GET',
                        url: '../lookup/sla.php',
                        data: ({project:project_code}),
                        dataType: 'html',
                        success: function (sla) {
                            // console.log(data);
                            if (sla != "") {
                                $('#incident_sla').val(sla); //assign sla to input field
                                $('#incident_severity').load('../lookup/severity.php?sla='+sla + '&selected='+$('#severity').val(), function() {    }); 
                                
                            }                               
                        }
                });

                $( 'select#incident_client').load('../lookup/client_filtered.php?selected='+client+'&code=128', function() {  })    
                $( "#incident_contact_person" ).val('');
                $( "#incident_contact_no" ).val('');
                $( "#incident_site_address" ).val('');
                $( "#incident_site_id" ).val('');
                $( "#incident_site_name" ).val('');
                $( "#incident_addr_id" ).val('');            
            })

            $( "#incident_site_name" ).autocomplete({
                source: function(request, response) {
                    // alert($('#incident_project').val())
                    $.ajax({
                        url: "../lookup/site.php",
                        dataType: "json",
                        data: {
                            term: request.term,
                            project_code: $('#incident_project').val()
                        },
                        success: function(data) {
                            // alert($('#incident_client').val());
                            response(data);
                        }
                    });
                },          
                minLength: 1,
                select: function( event, ui ) {
                    var address = ui.item.addr1+'\n'+ui.item.addr2+'\n'+ui.item.postcode+' '+ui.item.city+'\n'+ui.item.statename;
                     $( "#incident_client" ).val(ui.item.client);
                    $( "#incident_project" ).val(ui.item.project);
                   $( "#incident_site_address" ).val(address);
                    $( "#incident_site_id" ).val(ui.item.desc);
                    $( "#incident_addr_id" ).val(ui.item.addr_id);
                    var project_code = ui.item.project;
                    $.ajax({
                            type: 'GET',
                            url: '../lookup/sla.php',
                            data: ({project:project_code}),
                            dataType: 'html',
                            success: function (sla) {
                                // console.log(data);
                                if (sla != "") {
                                    $('#incident_sla').val(sla); //assign sla to input field
                                    $('#incident_severity').load('../lookup/severity.php?sla='+sla + '&selected='+$('#severity').val(), function() {    }); 
                                    
                                }                               
                            }
                    });                    
                }
            });            
            $( "#incident_contact_person" ).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "../lookup/contact_person.php",
                        dataType: "json",
                        data: {
                            term: request.term,
                            project_code: $('#incident_project').val(),
                            site_id: $('#incident_site_id').val()
                        },
                        success: function(data) {
                            // alert($('#incident_client').val());
                            response(data);
                        }
                    });
                },          
                minLength: 1,
                select: function( event, ui ) {
                    var address = ui.item.addr1+'\n'+ui.item.addr2+'\n'+ui.item.postcode+' '+ui.item.city+'\n'+ui.item.statename;
                    $( "#incident_client" ).val(ui.item.client);
                    $( "#incident_project" ).val(ui.item.project);
                    var project_code = ui.item.project;
                    $.ajax({
                            type: 'GET',
                            url: '../lookup/sla.php',
                            data: ({project:project_code}),
                            dataType: 'html',
                            success: function (sla) {
                                // console.log(data);
                                if (sla != "") {
                                    $('#incident_sla').val(sla); //assign sla to input field
                                    $('#incident_severity').load('../lookup/severity.php?sla='+sla + '&selected='+$('#severity').val(), function() {    }); 
                                    
                                }                               
                            }
                    });
                    $( "#incident_contact_no" ).val(ui.item.desc);
                    $( "#incident_site_address" ).val(address);
                    $( "#incident_site_id" ).val(ui.item.site_id);
                    $( "#incident_site_name" ).val(ui.item.site);
                    $( "#incident_addr_id" ).val(ui.item.addr_id);
                }
            })
            .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
                .appendTo( ul );
            };      
            $( "#incident_sn" ).autocomplete({
                source: function(request, response) {
                    // alert($('#incident_project').val());
                    // alert($( "#incident_project" ).val());
                    $.ajax({
                        url: "../lookup/sn.php",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            // alert(data);
                            response(data);
                        }
                    });
                },          
                minLength: 1,
                select: function( event, ui ) {
                     // $( "#incident_client" ).val(ui.item.client);
                    // alert(ui.item.machine)    ;
                    $( 'select#incident_client').val(ui.item.client);    
                    $( 'select#incident_project').val(ui.item.project);
                    $( 'select#incident_machine').val(ui.item.machine);
             
                }
            });         
            $('#incident_recurrence_check').change(function(){
                if($(this).is(':checked')) {
                    $("#incident_recurrence").show();
                } else {
                    $("#incident_recurrence").hide();
                }
            });

           $('#btn_save_incident').click(function(){
                var valid = false;
                  $.ajax({
                    async: "false",
                    type: "POST",
                    url: "save.php",
                    data: ({
                        client          : $("#incident_client").val()  ,
                        project         : $("#incident_project").val()  ,
                        site            : $("#incident_site_id").val()  ,
                        address         : $("#incident_addr_id").val()  ,
                        report_channel  : $("#incident_report_channel").val()  ,
                        contact_person  : $("#incident_contact_person").val()  ,
                        contact_no      : $("#incident_contact_no").val()  ,
                        add_info        : $("#incident_add_info").val()  ,
                        title           : $("#incident_title").val()  ,
                        description     : $("#incident_description").val()  ,
                        sn              : $("#incident_sn").val()  ,
                        // asset           : $("#incident_asset").val()  ,
                        service_type    : $("#incident_service_type").val()  ,
                        category        : $("#incident_category").val()  ,
                        machine         : $("#incident_machine").val()  ,
                        sla             : $("#incident_sla").val()  ,
                        severity        : $("#incident_severity").val()  ,
                        recurrence      : $("#incident_recurrence").val()  

                          }) ,
                    success: function(data){
                          alert (data)
                      if(data!=""){ 
                        var isemail="";
                        if ($("#incident_add_info").val()!='' ) {
                            var $email =$("#incident_add_info").val();
                            var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
                            if (!re.test($email)) {
                                alert('Please enter valid email.');
                                return false;
                            }else{
                                isemail = 'true';
                            }
                        };
                        if (isemail =='true') {
                            var msg = '<i class="fa fa-info-circle"></i> Incident details saved. Sending notification mail to ' + $email+'.';
                            var div = $("<div>" + msg + "</div>");
                            div.dialog({
                                title: "Processing",
                                modal:true                       });                            
                          $.ajax({
                            type: "POST",
                            url: "email/email.php",
                            data: ({case_id : data, email :$("#incident_add_info").val()})  ,
                            success: function(data){
                              alert(data);
                                window.location.href="index.php";
                                    }
                          });
                        }else{
                            window.location.href="index.php";
                        }

                      }

                      else{//true
                            valid = false;
                            alert('fail')
                      }
                    } 
                  }); 
            })
    </script>
<?php
}else{
include ("../nav/access_denied.php");
}
include ("../nav/footer.php");
?>
