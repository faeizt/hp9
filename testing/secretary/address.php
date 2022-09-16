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
<input type="hidden" id="state" value="<?=$row['state']?>">

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
    <?if($id!=""){?><li class="" id="div-address-remove" ><a class=" btn-danger" id="btn-address-remove"><span class="glyphicon glyphicon-trash"></span> Delete</a></li><?}?>

  </ul>          
</div><!--/.nav-collapse -->     
</nav><!--/.navbar-default -->
<!-- end of Submenu -->

<!-- beginning of content -->
  <div data-spy="scroll" data-target="#navbarExample" data-offset="50" class="scrollspy-example  pull-right" style="padding:10px">
    <fieldset>
            <!-- address-line1 input-->
 <div style="clear:both" id="com_personnel_alert-container" class="alert alert-info">
    <i id="com_personnel_alert-icon" class="icon-lightbulb"></i> <span id="com_personnel_alert"> Make your changes & hit save button.</span>
  </div>  

        <div class="form-group">
            <label class="col-sm-4 control-label">Location Name</label>
            <div class="col-sm-7">
                <input id="personnel_loc_name" name="address-name" type="text" placeholder="Location name" value="<?=$row['loc_name'];?>" 
                class="form-control">
                <p class="help-block"> </p>
            </div>
        </div>            
        <div class="form-group">
            <label class="col-sm-4 control-label">Address Line 1</label>
            <div class="col-sm-7">
                <input id="personnel_address_line1" name="address-line1" type="text" placeholder="address line 1" value="<?=$row['addr_1'];?>" 
                class="form-control">
                <p class="help-block">Apartment, suite , unit, building, floor, etc. </p>
            </div>
        </div>
        <!-- address-line2 input-->
        <div class="form-group">
            <label class="col-sm-4 control-label">Address Line 2</label>
            <div class="col-sm-7">
                <input id="personnel_address_line2" name="address-line2" type="text" placeholder="address line 2"  value="<?=$row['addr_2'];?>" 
                class="form-control">
                <p class="help-block">Street address, P.O. box,</p>
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

    <script type="text/javascript">
        $('select#personnel_state').load('../lookup/state.php?selected='+$('#state').val(), function() {  })    

        $('#btn-address-remove').click(function(){
            $.ajax({
                url: 'address_remove.php',
                async: "false",
                type: "POST",
                data: ({
                        app_no:$('#app_no').val(),
                        id:$('#id').val()
                    }),
                success: function( data ){ 
                    if(data=="false"){ 

                      $('#com_personnel_alert').text("Opss!!, Unable to remove.");
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

                      $("#id").val('');
                      $("#personnel_loc_name").val('')  ;
                      $("#personnel_address_line1").val('')  ;
                      $("#personnel_address_line2").val('')  ;
                      $("#personnel_postcode").val('')  ;
                      $("#personnel_city").val('')  ;
                      $("#personnel_state").val('')     ;        
                      $('#div-address-remove').hide()                     
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
                    loc_name: $("#personnel_loc_name").val(),
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

                      $('#com_personnel_alert').text("Opss!!, unable to save the information.");
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