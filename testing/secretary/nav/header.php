<?session_start();
if (!isset($_SESSION['username'])){
      header( 'Location: ../index.html' ) ;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <!-- Add custom CSS here -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <!-- JavaScript -->

    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>    
    <script src="../js/bootstrap.js"></script>
    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../js/jquery.easypiechart.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>   
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
          <a class="navbar-brand" ><FONT color="fefefe">THE</FONT> <FONT color="3ca6fb">SECRETARY &nbsp;</FONT></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
<!--             <li><a href="../"><i class="fa fa-dashboard"></i> Dashboard</a></li>
 -->            <li><a href="../application"><i class="fa fa-table"></i> Application</a></li>
            <li class="active"><a href="../secretary"><i class="fa fa-bar-chart-o"></i> Configuration</a></li>
<!--             <li><a href="../company"><i class="fa fa-edit"></i> Company</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
                <li><a href="#">Another Item</a></li>
                <li><a href="#">Third Item</a></li>
                <li><a href="#">Last Item</a></li>
              </ul>
            </li> -->
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['username']?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li class="divider"></li>
                <li><a href="../logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>