<?php
$nav_level = $_SESSION['nav_level'];
$nav_title = $_SESSION['nav_title'];
$nav_control = "";
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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" type="image/vnd.microsoft.icon" href="<?=$nav_control?>favicon.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=$nav_control?>css/bootstrap.css" rel="stylesheet">
    <link href="<?=$nav_control?>jquery-ui-1.10.3/css/flick/jquery-ui.css"rel="stylesheet" >
    <!-- Add custom CSS here -->
    <link href="<?=$nav_control?>css/sb-admin.css" rel="stylesheet">
    <link href="<?=$nav_control?>font-awesome3/css/font-awesome.min.css"rel="stylesheet">
    <link href="<?=$nav_control?>bootstrap3-editable-1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="<?=$nav_control?>font-awesome-4.0.3/css/font-awesome.css" rel="stylesheet">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" type="text/css" media="all" href="<?=$nav_control?>css/daterangepicker-bs3.css" />
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <!-- JavaScript -->

    <script src="<?=$nav_control?>js/jquery-1.10.2.min.js"></script>
    <script src="<?=$nav_control?>jquery-ui-1.10.3/js/jquery-ui.js"></script>    
    <script src="<?=$nav_control?>js/bootstrap.js"></script>
    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?=$nav_control?>js/jquery.easypiechart.min.js"></script>
    <script src="<?=$nav_control?>bootstrap3-editable-1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>   
      <script type="text/javascript" src="<?=$nav_control?>js/moment.js"></script>
      <script type="text/javascript" src="<?=$nav_control?>js/daterangepicker.js"></script>    
    <script type="text/javascript">
        (function() {
            var link_element = document.createElement("link"),
                s = document.getElementsByTagName("script")[0];
            if (window.location.protocol !== "http:" && window.location.protocol !== "https:") {
                link_element.href = "http:";
            }
            link_element.href += "//fonts.googleapis.com/css?family=Open+Sans:300italic,300,400italic,400,600italic,600,700italic,700,800italic,800";
            link_element.rel = "stylesheet";
            link_element.type = "text/css";
            s.parentNode.insertBefore(link_element, s);
        })();
    </script>

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
          <a class="navbar-brand" ><FONT color="fefefe">THE</FONT> <FONT color="3ca6fb">HELPDESK &nbsp;</FONT></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
        <style type="text/css">
        .side-nav li i{ font-size: 25px; }
        </style>
          <ul class="nav navbar-nav side-nav">
          <li class="side-user hidden-xs" style="width: 225px;background: brown; color:antiquewhite;text-align: left;padding: 10px;">
              <div class="row">
                <div class="col-md-4"><img class="media-object img-circle" src="<?=$nav_control?>images/uploads/<?=$_SESSION['profile_image']?>" alt="" style="width: 70px;height: 70px;"></div>
                <div class="col-md-8"><br/><i style="font-size:15px" class="fa fa-key"></i> <br/>Logged in as <?=$_SESSION['name']?></div>
              </div>
              <div class="clearfix"></div>

            </li>

            <li<?php if ($nav_title == "dasboard"){?> class="active"<?php } ?>><a href="<?=$nav_control?>"><span><i class="fa fa-dashboard"></i></span> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DASHBOARD</span></a></li>
            <li<?php if ($nav_title == "incident"){?> class="active"<?php } ?>><a href="<?=$nav_control?>incident"><span><i class="fa fa-wrench"></i></span> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INCIDENT</span></a></li>
            <li<?php if ($nav_title == "report"){?> class="active"<?php } ?>><a href="<?=$nav_control?>report"><span><i class="fa fa-signal"></i></span> <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REPORT</span></a></li>
            <li<?php if ($nav_title == "inventory"){?> class="active"<?php } ?>><a href="<?=$nav_control?>inventory"><span><i class="fa fa-dropbox"></i></span> <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INVENTORY</span></a></li>
            <li<?php if ($nav_title == "config"){?> class="active"<?php } ?>><a href="<?=$nav_control?>config"><span><i class="fa fa-cogs"></i></span> <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SETTING</span></a></li>
          </ul>

          <?php
          /*

          <?php

                  $dir_query = "SELECT * FROM evidence where case_id='$case_id'"; 
                  $dir_result = mysqli_query($con,$dir_query) or die(mysqli_error($con));
                  $dir_num  = mysqli_num_rows($dir_result);
                  $i = 1;
                  if($dir_num>0){
                    while($dir_row = mysqli_fetch_array($dir_result)){?> 
            <div class="" style="border:1px solid #f5f5f5;padding:5px"  >              
              <a href="../uploads/<?=$dir_row['name']?>" target="_blank"><i class="icon-paper-clip"></i> <?=$dir_row['name']?></a><span class="label label-info" style="float:right"><?=number_format($dir_row['size']/1024)?> KB</span></div>
              <?php
                            $i++;
            }}?>  

            */
            ?>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Notification <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?=$nav_control?>profile?user=<?=$_SESSION['username']?>"><i class="fa fa-user"></i> Profile</a></li>
                <li class="divider"></li>
                <li><a href="<?=$nav_control?>notification"><i class="fa fa-power-off"></i> View All Notification </a></li>
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

<script type="text/javascript">
$('select#status_list').load('../lookup/status.php?selected=', function() {  })    
$('select#status_list').change(function(){
  if ($(this).val() == "1") { $('#div_onsite_time').show('slow');$('#div_remarks').hide('slow');$('#div_resolve_type').hide('fast');$('#div_resolve_time').hide('fast');$('#div_resolution').hide('fast')}
  if ($(this).val() == "3") { $('#div_remarks').show('slow'); $('#div_onsite_time').hide('slow');$('#div_resolve_type').hide('fast');$('#div_resolve_time').hide('fast');$('#div_resolution').hide('fast')}
  if ($(this).val() == "4") { $('#div_onsite_time').show('fast');$('#div_remarks').hide('slow');$('#div_resolve_type').show('fast');$('#div_resolve_time').show('fast');$('#div_resolution').show('fast')}
  if ($(this).val() == "5") { $('#div_onsite_time').show('fast');$('#div_remarks').hide('slow');$('#div_resolve_type').show('fast');$('#div_resolve_time').show('fast');$('#div_resolution').show('fast')}
                           
}) 
</script>