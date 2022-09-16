<?
include "../application/nav/header.php";
include '../DB.php';
$app_no="";
$role="";
$id="";

if(isset($_GET['app_no'])){
    $app_no     =   htmlspecialchars(trim($_GET['app_no']));
    if(isset($_GET['id'])){    $id     =   htmlspecialchars(trim($_GET['id']));}

        $sqlquery   =   "SELECT * FROM v_personnel where id='$id'";        

    // echo $sqlquery;
    $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
    $row        =   mysqli_fetch_array( $result );
}
?>
<input type="hidden" id="app_no" value="<?if(isset($app_no)){echo $app_no;}?>">
<input type="hidden" id="id" value="<?if(isset($id)){echo $id;}?>">
<input type="hidden" id="salutation" value="<?=$row['pangkat']?>">
<input type="hidden" id="nationality" value="<?=$row['warganegara']?>">
<input type="hidden" id="sex" value="<?=$row['jantina']?>">
<!-- Submenu Navigation -->
<nav class="navbar navbar-default submenu col-xs-12 col-sm-12  col-md-12 pull-right" style="position:fixed;z-index:1;overflow:hidden" role="navigation" >
<div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".submenu-colls">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>   
  <a class="navbar-brand" href="index.html"> <FONT color="3ca6fb">Submenu &nbsp;</FONT></a>

  </div>   
<div id="navbarExample" style=" min-width: 850px;" class="collapse navbar-collapse submenu-colls">
  <ul class="nav navbar-nav ">
    <li class=""><a href="index.php?app_no=<?=$app_no?>"><span class="glyphicon glyphicon-chevron-left"></span> Back</a></li>
    <li class="" id="btn-new-crew"><a ><span class="glyphicon glyphicon-file"></span></span> New</a></li>
    <li class="" id="btn-save-crew"><a ><span class="glyphicon glyphicon-floppy-disk"></span></span> Save</a></li>
    <?if($id!=""){?><li class="" id="div-com-personnel-del" ><a class=" btn-danger" id="btn-com-personnel-remove"><span class="glyphicon glyphicon-trash"></span> Delete</a></li><?}?>

  </ul>          
</div><!--/.nav-collapse -->     
</nav><!--/.navbar-default -->
<!-- end of Submenu -->

<!-- beginning of content -->
  <div data-spy="scroll" data-target="#navbarExample" data-offset="50" class="scrollspy-example  pull-right" style="padding:10px">
  <div style="clear:both" id="com_personnel_alert-container" class="alert alert-info">
    <i id="com_personnel_alert-icon" class="icon-lightbulb"></i> <span id="com_personnel_alert"> Make your changes & hit save button.</span>
  </div>  

    <fieldset>
            <!-- address-line1 input-->
        <div class="form-group">
            <label class="col-sm-4 control-label">Salutation</label>
            <div class="col-sm-7">
                <select id="personnel_salutation" class="form-control" ></select>
                <p class="help-block"></p>
            </div>
        </div>        
        <div class="form-group">
            <label class="col-sm-4 control-label">Name</label>
            <div class="col-sm-7">
                <input id="personnel_name" name="full-name" type="text" placeholder="Name" value="<?=$row['name'];?>" 
                class="form-control">
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Designation</label>
            <div class="col-sm-7">
                <input id="personnel_designation" name="full-name" type="text" placeholder="Designation" value="<?=$row['designation'];?>" 
                class="form-control">
                <p class="help-block"></p>
            </div>
        </div>        
        <div class="form-group">
            <label class="col-sm-4 control-label">IC / Passport No</label>
            <div class="col-sm-7">
                <input id="personnel_ic" name="full-name" type="text" placeholder="Identification or Passport Number" value="<?=$row['ic'];?>" 
                class="form-control">
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nationality</label>
            <div class="col-sm-7">
                <select id="personnel_nationality" class="form-control" ></select>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Race / Ethnicity </label>
            <div class="col-sm-7">
                <input id="personnel_race" name="full-name" type="text" placeholder="Race or Ethnicity" value="<?=$row['race'];?>" 
                class="form-control">
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Sex</label>
            <div class="col-sm-7">
                <select id="personnel_sex" class="form-control" ></select>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Office Phone Number</label>
            <div class="col-sm-7">
                <input id="personnel_phone_office" name="full-name" type="text" placeholder="Office Phone Number" value="<?=$row['phone_office'];?>" 
                class="form-control">
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">HandPhone Number</label>
            <div class="col-sm-7">
                <input id="personnel_phone_hp" name="full-name" type="text" placeholder="Handphone Number" value="<?=$row['phone_hp'];?>" 
                class="form-control">
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Email</label>
            <div class="col-sm-7">
                <input id="personnel_email" name="full-name" type="text" placeholder="Email" value="<?=$row['phone_hp'];?>" 
                class="form-control">
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">License No</label>
            <div class="col-sm-7">
                <input id="personnel_license_no" name="full-name" type="text" placeholder="licence Number" value="<?=$row['license_no'];?>" 
                class="form-control">
                <p class="help-block"></p>
            </div>
        </div>

        </fieldset>
  </div>
<!--   <div id="div-table-com-personnel" class="span4" style="padding-left: 15px;border-left: 1px solid #edeff1;box-shadow: inset 3px 0px 4px -1px #fafafa;height: 480px;overflow-y: auto;">

  </div> -->

</div>
<!-- <div class="pull-left" id="div-com-personnel-del" style="display:none"><a class="btn btn-danger" id="btn-com-personnel-remove">Remove Personnel</a></div>
<div class="pull-right" style="margin-bottom: 10px;"><a id="btn-save-personnel" class="btn btn-primary">Save personnel</a> </div> -->
</div>
    <script type="text/javascript">
        $('select#personnel_salutation').load('../lookup/salutation.php?selected='+$('#salutation').val(), function() {  })    
        $('select#personnel_nationality').load('../lookup/nationality.php?selected='+$('#nationality').val(), function() {  })    
        $('select#personnel_sex').load('../lookup/sex.php?selected='+$('#sex').val(), function() {  })    

        $('#btn-com-personnel-remove').click(function(){
            $.ajax({
                url: 'com_personnel_remove.php',
                async: "false",
                type: "POST",
                data: ({
                        app_no:$('#app_no').val(),
                        id:$('#id').val(),
                    }),
                success: function( data ){ 
                    if(data=="false"){ 

                      $('#com_personnel_alert').text("Opss!!, Please select name to remove");
                      $('#com_personnel_alert-icon').removeClass();
                      $('#com_personnel_alert-icon').addClass("icon-exclamation-sign");
                      $('#com_personnel_alert-container').removeClass("alert-info");
                      $('#com_personnel_alert-container').addClass("alert-error");
                      $('#com_personnel_alert-container').effect("pulsate", { times:2 }, 500);
                    }
                    else if(data=="true"){
                      $('#com_personnel_alert').text("Information successfully removed from database.");
                      $('#com_personnel_alert-icon').removeClass();
                      $('#com_personnel_alert-icon').addClass("icon-ok");
                      $('#com_personnel_alert-container').removeClass("alert-info");
                      $('#com_personnel_alert-container').removeClass("alert-error");
                      $('#com_personnel_alert-container').addClass("alert-success");
                      $('#com_personnel_alert-container').effect("pulsate", { times:2 }, 500);                
                      $('#id').val('');
                      $("#personnel_salutation").val('');
                      $("#personnel_name").val('')  ;
                      $("#personnel_ic").val('')  ;
                      $("#personnel_designation").val('')  ;                      
                      $("#personnel_nationality").val('')  ;
                      $("#personnel_race").val('')  ;
                      $("#personnel_sex").val('')  ;
                      $("#personnel_phone_office").val('')  ;
                      $("#personnel_phone_hp").val('')  ;
                      $("#personnel_email").val('')  ;
                      $("#personnel_license_no").val('')  ;
                      $('#div-com-personnel-del').hide()                     
                 }
                    else{ 

                      $('#com_personnel_alert').text("Opss!!, Please select name to remove");
                      $('#com_personnel_alert-icon').removeClass();
                      $('#com_personnel_alert-icon').addClass("icon-exclamation-sign");
                      $('#com_personnel_alert-container').removeClass("alert-info");
                      $('#com_personnel_alert-container').addClass("alert-error");
                      $('#com_personnel_alert-container').effect("pulsate", { times:2 }, 500);
                    }                    
                }           
            });         
        })
        $('#btn-new-crew').click(function(){
            $("#id").val('');
            $("#personnel_salutation").val('');
            $("#personnel_name").val('')  ;
            $("#personnel_ic").val('')  ;
            $("#personnel_nationality").val('')  ;
            $("#personnel_race").val('')  ;
            $("#personnel_sex").val('')  ;
            $("#personnel_phone_office").val('')  ;
            $("#personnel_phone_hp").val('')  ;
            $("#personnel_email").val('')  ;
            $("#personnel_designation").val('')  ;
            $("#personnel_dob").val('')  ;
            $("#personnel_license_no").val('')  ;

            $('#div-com-personnel-del').hide() ;
        });
        $('#btn-save-crew').click(function(){
	        $.ajax({
	          async: "false",
	          type: "POST",
	          url: "crew_add.php",
	          data: ({
                    id:$("#id").val(),
                  app_no: $("#app_no").val(),
                  app_type: 'N',
                  role  :  '4',
                  salutation: $("#personnel_salutation").val(),
                  name: $("#personnel_name").val()  ,
                  designation:$("#personnel_designation").val()  ,
                  ic: $("#personnel_ic").val()  ,
                  nationality: $("#personnel_nationality").val()  ,
                  race: $("#personnel_race").val()  ,
                  sex: $("#personnel_sex").val()  ,
                  phone_office: $("#personnel_phone_office").val()  ,
                  phone_hp: $("#personnel_phone_hp").val()  ,
                  email: $("#personnel_email").val()  ,
                  license_no: $("#personnel_license_no").val()  
	                }) ,

	          success: function(data){
                    var data = data.split(',');

                    if(data[0]=="false"){ 

                      $('#com_personnel_alert').text("Opss!!, invalid login information");
                      $('#com_personnel_alert-icon').removeClass();
                      $('#com_personnel_alert-icon').addClass("icon-exclamation-sign");
                      $('#com_personnel_alert-container').removeClass("alert-info");
                      $('#com_personnel_alert-container').addClass("alert-error");
                      $('#com_personnel_alert-container').effect("pulsate", { times:2 }, 500);
                    }
                    else if(data[0]=="true"){
                      $('#com_personnel_alert').text("Information successfully saved into database.");
                      $('#com_personnel_alert-icon').removeClass();
                      $('#com_personnel_alert-icon').addClass("icon-ok");
                      $('#com_personnel_alert-container').removeClass("alert-info");
                      $('#com_personnel_alert-container').removeClass("alert-error");
                      $('#com_personnel_alert-container').addClass("alert-success");
                      $('#com_personnel_alert-container').effect("pulsate", { times:2 }, 500);                      
                      $("#app_no").val(data[1]);
                      $("#id").val(data[2]);
                      $('#div-com-personnel-del').show() ;
                      // alert(data[1]);
                      // alert(data[2]);
      //                 	$('#personnel_id').val('');
						// $('#com_personnel').val('');
						// $('#com_descr').val('');
      	                // $('#div-table-com-name').load('com_personnel_view_all.php?app_no='+$('#app_no').val(), function() {});
                        // if ($('#role').val()!="3"){ 
                        //     $('#div-table-com-personnel').load('com_personnel_view_all.php?role='+$('#role').val()+'&app_no='+$('#app_no').val(), function() {});

                        //     $("#personnel_id").val(''),
                        //     $("#personnel_salutation").val(''),
                        //     $("#personnel_name").val('')  ,
                        //     $("#personnel_ic").val('')  ,
                        //     $("#personnel_nationality").val('')  ,
                        //     $("#personnel_race").val('')  ,
                        //     $("#personnel_sex").val('')  ,
                        //     $("#personnel_phone_office").val('')  ,
                        //     $("#personnel_phone_hp").val('')  ,
                        //     $("#personnel_fax").val('')  ,
                        //     $("#personnel_email").val('')  ,
                        //     $("#personnel_address_line1").val('')  ,
                        //     $("#personnel_address_line2").val('')  ,
                        //     $("#personnel_postcode").val('')  ,
                        //     $("#personnel_city").val('')  ,
                        //     $("#personnel_state").val('')              
                        //     $("#personnel_share_percent").val('')  ,
                        //     $("#personnel_share_unit").val('')  
                        //     $('#div-com-personnel-del').hide() 
                        // }

                    }
                    else{ 

                      $('#com_personnel_alert').text("Opss!!, invalid login information");
                      $('#com_personnel_alert-icon').removeClass();
                      $('#com_personnel_alert-icon').addClass("icon-exclamation-sign");
                      $('#com_personnel_alert-container').removeClass("alert-info");
                      $('#com_personnel_alert-container').addClass("alert-error");
                      $('#com_personnel_alert-container').effect("pulsate", { times:2 }, 500);
                    }                    
	          } 
	        }); 
		});        


</script>