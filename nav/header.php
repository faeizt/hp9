<?php
$nav_level = $_SESSION['nav_level'];
$nav_title = $_SESSION['nav_title'];
$user_access  = 0;
$user_access2 = 0;
$user_access3 = 0;
$nav_control  = "";
$i = 0;
  while ($i < $nav_level) {
    $nav_control = $nav_control."../";
    $i++;
  } 
$redirect_url = $nav_control."index.html";

if (!isset($_SESSION['username'])){
      header("Location: $redirect_url") ;
}
$pic_theme = "red";

switch ($_SESSION['usertype']) {
   case 0: $pic_theme = "brown"; break; #admin
   case 1: $pic_theme = "darkslategray"; break; #engineer
   case 2: $pic_theme = "royalblue"; break; #helpdesk
   case 3: $pic_theme = "teal"; break; #client
   case 4: $pic_theme = "steelblue"; break; #manager
}

include $nav_control.'DB.php';

$access_query     =   "SELECT access, access2, access3 FROM sys_users WHERE user_id = ".$_SESSION['user_id']  ;      // echo $sqlquery;
$result           =   mysqli_query($con,$access_query) or die("sql= ". $access_query);          //query
$row              =   mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_access      =   intval($row['access']);
$user_access2     =   intval($row['access2']);
$user_access3     =   intval($row['access3']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" type="image/vnd.microsoft.icon" href="<?=$nav_control?>favicon.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Crossroad Helpdesk System</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=$nav_control?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=$nav_control?>jquery-ui-1.10.3/css/flick/jquery-ui.css"rel="stylesheet" >
    <!-- Add custom CSS here -->
    <link href="<?=$nav_control?>css/sb-admin.css" rel="stylesheet">
    <link href="<?=$nav_control?>css/dataTables.bootstrap.css" rel="stylesheet">    
    <link href="<?=$nav_control?>font-awesome3/css/font-awesome.min.css"rel="stylesheet">
    <link href="<?=$nav_control?>bootstrap3-editable-1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="<?=$nav_control?>font-awesome-4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" type="text/css" media="all" href="<?=$nav_control?>css/daterangepicker-bs3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.4.3/morris.css">
    <!-- JavaScript -->

    <script src="<?=$nav_control?>js/jquery-1.10.2.min.js"></script>
    <script src="<?=$nav_control?>jquery-ui-1.10.3/js/jquery-ui.js"></script>    
    <script src="<?=$nav_control?>js/bootstrap.js"></script>
    <script src="<?=$nav_control?>js/jquery.dataTables.js"></script>
    <script src="<?=$nav_control?>js/dataTables.bootstrap.js"></script>
    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?=$nav_control?>js/jquery.easypiechart.min.js"></script>
    <script src="<?=$nav_control?>bootstrap3-editable-1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>   
    <script type="text/javascript" src="<?=$nav_control?>js/moment.js"></script>
    <script type="text/javascript" src="<?=$nav_control?>js/daterangepicker.js"></script>    

    <script type="text/javascript">
      function genLoader(t,data,p){
        var term = t;
        var tdata= data;
        var page = 'add-case.php';
        var search="";
        if (p){page = p;}
        if(term=='fltrt1')    {   $("#fltrt1").val(tdata);    }//$('select option[value="MARA01"]').attr("selected",true);;
        else if(term=='fltrt2') {   $("#fltrt2").val(tdata);}
        else if(term=='fltrt3') {   $("#fltrt3").val(tdata);}
        else if(term=='fltrt4') {   $("#fltrt4").val(tdata);}
        else if(term=='fltrt5') {   $("#fltrt5").val(tdata);}
        else if(term=='fltrt6') {   $("#fltrt6").val(tdata);}
        else if(term=='srcht')  {   $("#search").val(tdata); }
        else if(term=='fltr2')  {   $("#fltr2").val(tdata); }
        else if(term=='srt')  {   $("#srt").val(tdata); } 
        else{}
        var loader = page +'?srch=y&srcht='+encodeURIComponent($("#search").val())+'&fltr2='+encodeURIComponent($("#fltr2").val())+'&fltr=y&fltrt1='+$("#fltrt1").val()+'&fltrt2='+$("#fltrt2").val()+'&fltrt3='+$("#fltrt3").val()+'&fltrt4='+$("#fltrt4").val()+'&fltrt5='+$("#fltrt5").val()+'&fltrt6='+$("#fltrt6").val()+'&srt='+encodeURIComponent($("#srt").val());
        return loader
      }

    </script> 
  </head>

  <body  data-spy="scroll" data-offset="0" data-target="#myScrollspy">

    <div id="wrapper" style="">

      <!-- Sidebar -->
      <nav  class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div id="nav-top" class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" ><FONT color="fefefe">CROSSROAD</FONT> <FONT color="3ca6fb">SUPPORT &nbsp;</FONT></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
        <style type="text/css">
        .side-nav li i{ font-size: 25px; }
        </style>
          <ul class="nav navbar-nav side-nav">
          <li class="side-user hidden-xs" style="width: 225px;background: <?=$pic_theme?>; color:antiquewhite;text-align: left;padding: 10px;">
              <div class="row">
                <div class="col-md-4"><img class="media-object img-circle" src="<?=$nav_control?>images/uploads/<?=$_SESSION['profile_image']?>" alt="" style="width: 70px;height: 70px;"></div>
                <div class="col-md-8"><br/><i style="font-size:15px" class="fa fa-key"></i> <br/>Logged in as <?=$_SESSION['name']?></div>
              </div>
              <div class="clearfix"></div>

            </li><?
            if (($user_access & 1) == 1) {?>
            <li<? if ($nav_title == "dashboard"){?> class="active"<?} ?>><a href="<?=$nav_control?>index.php"><span><i class="fa fa-dashboard"></i></span> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DASHBOARD</span></a></li>
            <?}else{}
            if (($user_access & 2) == 2) {?>
            <li<? if ($nav_title == "incident"){?> class="active"<?} ?>><a href="<?=$nav_control?>incident"><span><i class="fa fa-wrench"></i></span> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INCIDENT</span></a></li>
            <?}else{}
            if (($user_access & 4) == 4) {?>
            <li<? if ($nav_title == "report"){?> class="active"<?} ?>><a href="<?=$nav_control?>report"><span><i class="fa fa-signal"></i></span> <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REPORT</span></a></li>
            <?}else{}
            if (($user_access & 8) == 8) {?>
            <li<? if ($nav_title == "calendar"){?> class="active"<?} ?>><a href="<?=$nav_control?>calendar"><span><i class="fa fa-calendar"></i></span> <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CALENDAR</span></a></li>
            <?}else{}
            if (($user_access & 16) == 16) {?>
            <li<? if ($nav_title == "inventory"){?> class="active"<?} ?>><a href="<?=$nav_control?>inventory"><span><i class="fa fa-dropbox"></i></span> <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRODUCT LIST</span></a></li>
            <?}else{}
            if (($user_access & 32) == 32) {?>
            <li<? if ($nav_title == "config"){?> class="active"<?} ?>><a href="<?=$nav_control?>config"><span><i class="fa fa-cogs"></i></span> <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SETTING</span></a></li>
            <?}else{}?>
          </ul>

          <?
          $user     = $_SESSION['username'];
          $sqlquery = "SELECT COUNT(id) unread FROM notification WHERE seen = 'N' and user = '$user'";
          $result   = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query
          $row      = mysqli_fetch_array( $result, MYSQLI_ASSOC );
          $new_not  = $row['unread'];

          $sqlquery = "SELECT id,case_id, msg,status, user, seen, notification, IF (SUBSTRING(updates,1,2) = '1 ' OR SUBSTRING(updates,1,2) = '0 ',REPLACE (updates,'s',''),updates) updates ".
                      "FROM (SELECT id,msg, case_id, code_name status, user, seen, CASE ".
                      "WHEN TIMESTAMPDIFF(MINUTE,date, NOW()) < 60 THEN CONCAT (TIMESTAMPDIFF(MINUTE,date, NOW()),' minutes ago') ".
                      "WHEN TIMESTAMPDIFF(HOUR,date, NOW()) < 24 THEN CONCAT (TIMESTAMPDIFF(HOUR,date, NOW()),' hours ago') ".
                      "WHEN TIMESTAMPDIFF(DAY,date, NOW()) < 30 THEN CONCAT (TIMESTAMPDIFF(DAY,date, NOW()),' days ago') ".
                      "WHEN TIMESTAMPDIFF(MONTH,date, NOW()) < 12 THEN CONCAT (TIMESTAMPDIFF(MONTH,date, NOW()),' months ago') ".                            
                      "ELSE CONCAT (TIMESTAMPDIFF(YEAR,date, NOW()),' years ago') ".  
                      "END updates,  DATE_FORMAT(date,'%d %b %Y %h:%i %p') notification ".
                      "FROM `notification` a, (SELECT * FROM `code_definition` WHERE code_cat = 'casestatus') b ".
                      "WHERE a.case_status =  b.code and seen = 'N' and user='$user'".
                      "ORDER BY a.date DESC) a;";
                      // echo $sqlquery;
          $result = mysqli_query($con, $sqlquery) or die("sql= ". $sqlquery);          //query
          $num  = mysqli_num_rows($result);

          $i=0;
          ?>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge"><? if ($new_not !="0") { echo " ".$new_not; } ?></span>
           Notification <b class="caret"></b></a>
              <ul id="notification" class="dropdown-menu">

              <?
              while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              $i++;
              ?>
                <li id='<?=$row['id']?>' case="<?=$row['case_id']?>"><a  ><i class="icon-file-alt"></i> <?=$row['case_id']?> : <?=$row['msg']?><br/><i><?=$row['updates']?></i></a></li>
              <?
              }
              ?>          
               
                <li class="divider"></li>
                <li><a href="<?=$nav_control?>notification"> View All Notification </a></li>
              </ul>
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['username']?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?=$nav_control?>profile?user=<?=$_SESSION['username']?>"><i class="fa fa-user"></i> Profile</a></li>
                <li class="divider"></li>
                <li><a href="<?=$nav_control?>logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>

        </div><!-- /.navbar-collapse -->
      </nav>

<?php

$current_path     =   $_SERVER['SCRIPT_FILENAME'];
//echo $current_path.'|'.$user_access;

$access_query     =   "SELECT IF(('$user_access' & access_id) = access_id, 'true', 'false') access_control, ".
                      "IF(('$user_access2' & access_id) = access_id, 'true', 'false') access_control2, ".
                      "IF(('$user_access3' & access_id) = access_id, 'true', 'false') access_control3 ".
                      " FROM access WHERE path = SUBSTRING_INDEX('$current_path','/',-('$nav_level'+1))"  ;      // echo $sqlquery;
$result           =   mysqli_query($con,$access_query) or die("sql= ". $access_query);          //query
$row              =   mysqli_fetch_array($result, MYSQLI_ASSOC);
$access_control   =   $row['access_control'];
$access_control2  =   $row['access_control2'];
$access_control3  =   $row['access_control3'];

//echo '<br/>'.$access_query.'|'.$access_control;

// if ($access_control == "true")echo '<br/>Access Granted';
// else echo '<br/>Access Restricted';

$access_query     =   "SELECT * FROM sys_user_ac WHERE user_id = ".$_SESSION['user_id'] ;      // echo $sqlquery;
$result           =   mysqli_query($con, $access_query) or die("sql= ". $access_query);          //query
$result_array = array();

while($row_ac = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$result_array[] = $row_ac;
}
// var_dump($result_array);
// echo $access_query;
?>

<script type="text/javascript">
$('#notification li').click(function(){ 
  var case_id = $(this).attr('case');
  $.ajax({
    type: "POST",
    url: "<?=$nav_control?>notification/update_notifier.php",
    data: ({    id      : $(this).attr('id')    }),
    success: function(data){
      window.location.href="<?=$nav_control?>notification/view.php?app_no="+case_id;
    } 
  }); 
})
$('select#status_list').load('<?=$nav_control?>lookup/status.php?selected=', function() {  })    
$('select#status_list').change(function(){
  if ($(this).val() == "1") { $('#div_onsite_time').show('slow');$('#div_remarks').hide('slow');$('#div_resolve_type').hide('fast');$('#div_resolve_time').hide('fast');$('#div_resolution').hide('fast')}
  if ($(this).val() == "3") { $('#div_remarks').show('slow'); $('#div_onsite_time').hide('slow');$('#div_resolve_type').hide('fast');$('#div_resolve_time').hide('fast');$('#div_resolution').hide('fast')}
  if ($(this).val() == "4") { $('#div_onsite_time').show('fast');$('#div_remarks').hide('slow');$('#div_resolve_type').show('fast');$('#div_resolve_time').show('fast');$('#div_resolution').show('fast')}
  if ($(this).val() == "5") { $('#div_onsite_time').show('fast');$('#div_remarks').hide('slow');$('#div_resolve_type').show('fast');$('#div_resolve_time').show('fast');$('#div_resolution').show('fast')}
                           
}) 
</script>