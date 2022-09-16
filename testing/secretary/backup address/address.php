<?
include "nav/header.php";
include '../DB.php';
$app_no="";
$role="";
$id="";

if(isset($_GET['app_no'])){
    $app_no     =   htmlspecialchars(trim($_GET['app_no']));
    if(isset($_GET['id'])){    $id     =   htmlspecialchars(trim($_GET['id']));}

        $sqlquery   =   "SELECT * FROM address where id='$id'";        

    // echo $sqlquery;
    $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
    $row        =   mysqli_fetch_array( $result );
}
?>
<input type="hidden" id="app_no" value="<?if(isset($app_no)){echo $app_no;}?>">
<input type="hidden" id="id" value="<?if(isset($id)){echo $id;}?>">

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
    <li class=""><a href="save_names.php"><span class="glyphicon glyphicon-file"></span></span> New</a></li>
    <li class="" id="btn-save-address"><a ><span class="glyphicon glyphicon-floppy-disk"></span></span> Save</a></li>
    <?if($role!="3"){?><li class="" id="div-com-address-del" ><a class=" btn-danger" id="btn-com-address-remove"><span class="glyphicon glyphicon-trash"></span> Delete</a></li><?}?>

  </ul>          
</div><!--/.nav-collapse -->     
</nav><!--/.navbar-default -->
<!-- end of Submenu -->

<!-- beginning of content -->
  <div data-spy="scroll" data-target="#navbarExample" data-offset="50" class="scrollspy-example  pull-right" style="padding:10px">
    <fieldset>
            <!-- address-line1 input-->
        <div class="form-group">
            <label class="col-sm-4 control-label">Location Name</label>
            <div class="col-sm-7">
                <input id="personal_loc_name" name="address-name" type="text" placeholder="Location name" value="<?=$row['loc_name'];?>" 
                class="form-control">
                <p class="help-block"> </p>
            </div>
        </div>            
        <div class="form-group">
            <label class="col-sm-4 control-label">Address Line 1</label>
            <div class="col-sm-7">
                <input id="personnel_address_line1" name="address-line1" type="text" placeholder="address line 1" value="<?=$row['addr_1'];?>" 
                class="form-control">
                <p class="help-block">Street address, P.O. box, </p>
            </div>
        </div>
        <!-- address-line2 input-->
        <div class="form-group">
            <label class="col-sm-4 control-label">Address Line 2</label>
            <div class="col-sm-7">
                <input id="personnel_address_line2" name="address-line2" type="text" placeholder="address line 2"  value="<?=$row['addr_2'];?>" 
                class="form-control">
                <p class="help-block">Apartment, suite , unit, building, floor, etc.</p>
            </div>
        </div>
        <!-- postal-code input-->
        <div class="form-group">
            <label class="col-sm-4 control-label">Zip / Postal Code</label>
            <div class="col-sm-7">
                <input id="personnel_postcode" name="postal-code" type="text" placeholder="zip or postal code" value="<?=$row['postcode'];?>" 
                class="form-control">
                <p class="help-block"></p>
            </div>
        </div>        
        <!-- city input-->
        <div class="form-group">
            <label class="col-sm-4 control-label">City / Town</label>
            <div class="col-sm-7">
                <input id="personnel_city" name="city" type="text" placeholder="city" class="form-control"  value="<?=$row['city'];?>" >
                <p class="help-block"></p>
            </div>
        </div>
        <!-- region input-->
        <div class="form-group">
            <label class="col-sm-4 control-label">State / Province </label>
            <div class="col-sm-7">
                <select id="personnel_state" class="form-control" ></select>
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
        $('select#personnel_salutation').load('../lookup/salutation.php?', function() {  })    
        $('select#personnel_nationality').load('../lookup/nationality.php', function() {  })    
        $('select#personnel_sex').load('../lookup/sex.php', function() {  })    
        $('select#personnel_state').load('../lookup/state.php', function() {  })    

//         if ($('#role').val()!="3"){ $('#div-table-com-personnel').load('com_personnel_view_all.php?role='+$('#role').val()+'&app_no='+$('#app_no').val(), function() {});
// }
        $('#btn-finish').click(function(){
            window.location.replace("app_view.php?app_no="+ $("#app_no").val());

        })


        $('#btn-next').click(function(){
            if($("#role").val()=="3"){          window.location.replace("com_name_form.php?app_no="+ $("#app_no").val());           }
            else if($("#role").val()=="1"){          window.location.replace("com_personnel_form.php?role=2&app_no="+ $("#app_no").val());           }

        })
        $('#btn-com-address-remove').click(function(){
            $.ajax({
                url: 'address_remove.php',
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
                                                $('#id').val('');

                     // $('#div-table-com-personnel').load('com_personnel_view_all.php?role='+$('#role').val()+'&app_no='+$('#app_no').val(), function() {});  
                            $("#id").val('');
                            $("#personnel_salutation").val('');
                            $("#personnel_name").val('')  ;
                            $("#personnel_ic").val('')  ;
                            $("#personnel_nationality").val('')  ;
                            $("#personnel_race").val('')  ;
                            $("#personnel_sex").val('')  ;
                            $("#personnel_phone_office").val('')  ;
                            $("#personnel_phone_hp").val('')  ;
                            $("#personnel_fax").val('')  ;
                            $("#personnel_email").val('')  ;
                            $("#personnel_loc_name").val('')  ;
                            $("#personnel_address_line1").val('')  ;
                            $("#personnel_address_line2").val('')  ;
                            $("#personnel_postcode").val('')  ;
                            $("#personnel_city").val('')  ;
                            $("#personnel_state").val('')     ;        
                            $("#personnel_share_percent").val('')  ;
                            $("#personnel_share_unit").val('')     ;                                   
                            $('#div-com-address-del').hide()                     
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

        $('#btn-save-address').click(function(){
	        $.ajax({
	          async: "false",
	          type: "POST",
	          url: "address_add.php",
	          data: ({
                    id:$("#id").val(),
	                app_no: $("#app_no").val(),
                    loc_name: $("#personal_loc_name").val(),
	                addr_1: $("#personnel_address_line1").val()  ,
	                addr_2: $("#personnel_address_line2").val()  ,
	                postcode: $("#personnel_postcode").val()  ,
	                city: $("#personnel_city").val()  ,
	                state: $("#personnel_state").val()  
	                }) ,

	          success: function(data){
	          		alert(data)
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
                      $("#app_no").val(data[1]);
                      $("#id").val(data[2]);

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
        $('#tbl-com-personnel tr').hover(function(){
            $(this).tooltip('show')
        })  
        $('#tbl-com-personnel tr').click(function(){
            $.ajax({
                url: 'com_personnel.php?callback=',
                data: ({app_no:$('#app_no').val(),id:$(this).attr('id')}),
                dataType: 'jsonp',
                success: function( data ){ 

                    var thumbs = [];

                                for(var i=0, l=data.length; i < l && i < 16; ++i) 
                                {
                                    $('#id').val(data[i].id);
                                    $('#personnel_role').val(data[i].role);
                                    $('#personnel_salutation').val(data[i].salutation);
                                    $('#id').val(data[i].name);
                                    $('#id').val(data[i].ic);
                                    $('#id').val(data[i].nationality);
                                    $('#id').val(data[i].race);
                                    $('#id').val(data[i].sex);
                                    $('#id').val(data[i].phone_office);
                                    $('#id').val(data[i].phone_hp);
                                    $('#id').val(data[i].fax);
                                    $('#id').val(data[i].email);
                                    $('#id').val(data[i].addr_1);
                                    $('#id').val(data[i].addr_2);
                                    $('#id').val(data[i].postcode);
                                    $('#id').val(data[i].city);
                                    $('#id').val(data[i].state);
                                    $('#id').val(data[i].country);

                                }
                                if ($('#id').val()!=""){$('#div-com-address-del').show();}


                }           
            });
        })

</script>