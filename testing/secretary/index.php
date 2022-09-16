<?
include ("nav/header.php");
?>
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
            <li class="active"><a href="#one"> Company Information</a></li>
            <li><a href="#two">Locations</a></li>
            <li><a href="#three">Personnels</a></li>
          </ul>          
        </div><!--/.nav-collapse -->     
      </nav><!--/.navbar-default -->
      <!-- end of Submenu -->

      <!-- beginning of content -->
      <?
      include '../DB.php'; //DB Connection String

        $app_no     =   "S001";
        $sqlquery   =   "SELECT * FROM v_app where app_no = '$app_no'";
        // echo $sqlquery;
        $result     =   mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
        $row        =   mysqli_fetch_array( $result );

      ?>
          <input type="hidden" id="app_no" value="<?if(isset($app_no)){echo $app_no;}?>">
          <div data-spy="scroll" data-target="#navbarExample" data-offset="50" class="scrollspy-example  pull-right" style="">
    
          <section id="one" style="margin-bottom:50px">
            <legend  class="pull-left col-xs-10 col-md-11">Company Information</legend>
            <legend class="pull-right col-xs-2 col-md-1"><button id="enable" type="button" class="btn btn-info  btn-xs">
              <span class="glyphicon glyphicon-edit"></span> Edit
            </button>
            </legend>
             
                <table id="user" class="table " style="clear:both">
                  <tr><TD>Nama Syarikat</TD><td>:</td><td><a href="#" id="com_name"><?=$row['com_name'];?></a></td></tr>
                  <tr><TD>Company Ref No</TD><td>:</td><td><a href="#" id="com_ref_no"><?=$row['com_ref_no'];?></a></td></tr>
                  <tr><TD>No Lesen Kewangan</TD><td>:</td><td><a href="#" id="finance_ref_no"><?=$row['finance_ref_no'];?></a></td></tr>
                  <tr><TD>No Lesen Bumiputra</TD><td>:</td><td><a href="#" id="bumiputra_ref_no"><?=$row['bumiputra_ref_no'];?></a></td></tr>
                  <tr><TD>Modal Syarikat</TD><td>:</td><td>RM <a href="#" id="capital"><?=$row['capital'];?></a></td></tr>
                  <tr><TD>Price Per Unit</TD><td>:</td><td>RM <a href="#" id="priceperunit"><?=$row['priceperunit'];?></a></td></tr>
                  <tr><TD>Bank</TD><td>:</td><td><a href="#" id="bank"><?=$row['bank'];?></a></td></tr>
                </table>
          </section>
                    <style type="text/css">
                .bs-glyphicons {
                padding-left: 0;
                padding-bottom: 1px;
                margin-bottom: 20px;
                list-style: none;
                overflow: hidden;
                }
                #two .bs-glyphicons li {
                float: left;
/*                width: 25%;
*/                min-height: 250px;
                padding: 10px;
                margin: 0 -1px -1px 0;
                font-size: 12px;
                line-height: 1.4;
                text-align: center;
                border: 1px solid #ddd;}  
                #three .bs-glyphicons li {
                float: left;
/*                width: 25%;
*/                min-height: 350px;
                padding: 10px;
                margin: 0 -1px -1px 0;
                font-size: 12px;
                line-height: 1.4;
                text-align: center;
                border: 1px solid #ddd;}          
                #two li:hover .edit,#three li:hover .edit{  display:inline;background-color: #E4F8FF; text-align: center}
                .edit {position: absolute;display: none;top: 1px;right: 1px;}
          </style>

          <section id="two">
            <legend class="pull-left col-xs-10 col-md-11"> <span class="glyphicon glyphicon-send"></span> Address</legend>
                        <legend class="pull-right col-xs-2 col-md-1">
              <button id="btn_add_address" type="button" class="btn btn-info  btn-xs">
                <span class="glyphicon glyphicon-edit"></span> Add
              </button>
            </legend>   
              <div style="clear:both"><ul class="bs-glyphicons"><?

      $query = "SELECT a.*,s.name as negeri FROM address a left join states s on a.state = s.id where personnel_id = '$app_no' "; 
      $result = mysqli_query($con,$query) or die(mysqli_error($con));
      $num  = mysqli_num_rows($result);
      $i = 1;
      if($num>0){
        while($row = mysqli_fetch_array($result)){?> 
        <li class="col-xs-12 col-sm-6 col-md-3">  
              <div >
                  <div class="caption">
                    <h4><?=$row['loc_name']?></h4>
                    <p><?=$row['addr_1'];?><br/><?=$row['addr_2'];?><br/><?=$row['postcode'];?> <?=$row['city'];?><br/><?=$row['negeri'];?></p>          
                    <div class="edit"><button data="<?=$row['id']?>"  class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span> Update</button></div>
                </div>
              </div>
              </li><?
                $i++;
            }}?>
  
              </div>
          </section>
          <section id="three">
            <legend class="pull-left col-xs-10 col-md-11"><span class="glyphicon glyphicon-user"></span> Crew</legend>
                        <legend class="pull-right col-xs-2 col-md-1">
              <button id="btn_add_crew" type="button" class="btn btn-info  btn-xs">
                <span class="glyphicon glyphicon-edit"></span> Add
              </button>
            </legend>   
              <div style="clear:both"><ul class="bs-glyphicons"><?

      $query = "SELECT * FROM v_personnel where app_no = '$app_no' and role='4'"; 
      $result = mysqli_query($con,$query) or die(mysqli_error($con));
      $num  = mysqli_num_rows($result);
      $i = 1;
      if($num>0){
        while($row = mysqli_fetch_array($result)){?> 
        <li class="col-xs-12 col-sm-6 col-md-3">  
              <div >
                  <div class="caption">
                    <h4><?=$row['name']?></h4>
                    <p><?=$row['ic'];?></p>          
                    <p><?=$row['designation'];?></p>
                    <p><?=$row['license_no'];?></p>
                    <div class="edit"><button data="<?=$row['id']?>"  class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span> Update</button></div>
                </div>
              </div>
              </li><?
                $i++;
            }}?>
  
              </div>
          </section>

</div>
<script type="text/javascript">
$( ".scrollspy-example" ).scroll(function() {
  $( ".navbar-fixed-top" ).css( "top", "-50px" );
  $( ".submenu" ).css( "top", "0px" );
  $( ".side-nav" ).css( "top", "0px" );
  $( ".scrollspy-example" ).css( "top", "50px" );

  if($(".scrollspy-example" ).scrollTop()==0){
    $( ".navbar-fixed-top" ).css( "top", "0px" );
    $( ".submenu" ).css( "top", "50px" );
    $( ".side-nav" ).css( "top", "50px" );
    $( ".scrollspy-example" ).css( "top", "100px" );
  };
});
$('#two li').hover(function(){
  $('.edit',this).css('display','inline');

  },function(){
    $('.edit',this).css('display','none');
})
$('#three li').hover(function(){
  $('.edit',this).css('display','inline');

  },function(){
    $('.edit',this).css('display','none');
})
$('#enable').click(function() {
   $('#user .editable').editable('toggleDisabled');
});

$('#btn_edit_names').click(function() {
      window.location.replace("com_name_form.php");
});
$('#btn_edit_actvities').click(function() {
      window.location.replace("com_activity_form.php");
});
$('#btn_edit_directors').click(function() {
      window.location.replace("com_personnel_form.php?role=1");
});
$('#btn_add_address').click(function() {
      window.location.replace("address.php?app_no="+$('#app_no').val());
});
$('#two .edit button').click(function() {
      window.location.replace("address.php?app_no="+ $("#app_no").val()+"&id="+$(this).attr('data'));
});
$('#btn_add_crew').click(function() {
      window.location.replace("crew.php?app_no="+$('#app_no').val());
});
$('#three .edit button').click(function() {
      window.location.replace("crew.php?app_no="+ $("#app_no").val()+"&id="+$(this).attr('data'));
});
$('#btn_edit_directors').click(function() {
      window.location.replace("com_personnel_form.php?role=1");
});
$('#btn_edit_shareholders').click(function() {
      window.location.replace("com_personnel_form.php?role=2");
});  
  $(document).ready(function() {
      //toggle `popup` / `inline` mode
      $.fn.editable.defaults.mode = 'inline';     
      $.fn.editable.defaults.disabled = 'true'; 


      //make username editable
      $('#com_name').editable({
          type: 'text',
          title: 'Enter Company Name',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });            
      $('#com_ref_no').editable({
          type: 'text',
          title: 'Enter Company Ref No',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });      
      $('#finance_ref_no').editable({
          type: 'text',
          title: 'Enter Finance Ref No.',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });   
      $('#bumiputra_ref_no').editable({
          type: 'text',
          title: 'Enter Bumiputra License No.',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });    
      $('#capital').editable({
          type: 'text',
          title: 'Enter Paid Capital',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });   
      $('#priceperunit').editable({
          type: 'text',
          title: 'Enter Price Per Unit',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });   
      $('#bank').editable({
          type: 'text',
          title: 'Enter Bank',
          placement: 'right',         
          pk: $('#app_no').val(),
          url: 'app_update.php'
          
      });                     //make status editable
      $('#status').editable({
          type: 'select',
          title: 'Select status',
          placement: 'right',
          value: 2,
          source: [
              {value: 1, text: 'status 1'},
              {value: 2, text: 'status 2'},
              {value: 3, text: 'status 3'}
          ]
          /*
          //uncomment these lines to send data on server
          ,pk: 1
          ,url: '/post'
          */
      });
  });   
</script>
<?
include ("nav/footer.php");
?>