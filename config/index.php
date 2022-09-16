<?
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "config";
include ("../nav/header.php");
if ($access_control == "true") {
?>

      <input type="hidden" id="rpt_page" value="1">
      <input type="hidden" id="srcht" value="">
      <input type="hidden" id="fltr2" value="">
      <input type="hidden" id="fltrt1" value="<?=$_SESSION['def_project']?>">
      <input type="hidden" id="fltrt2" value="">
      <input type="hidden" id="fltrt3" value="">
      <input type="hidden" id="fltrt4" value="">
      <input type="hidden" id="fltrt5" value="">
      <input type="hidden" id="fltrt6" value="">      
      <input type="hidden" id="srt" value="">                
      <div id="page-wrapper">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <h1>Configuration <small>Maintenance Page</small></h1>
                    <ol class="breadcrumb">
                      <li class="active"><i class="icon-cogs"></i> Configuration</li>
                    </ol>
                  </div>
                </div><!-- /.row -->
                <div class="table-responsive" id="div_app_list">

  <div id="seven" style="clear:both;margin-top:0px;padding:10px;">

    <p></p>  
<ul class="bs-glyphicons">
    <li><a href="client">
      <div>
      <p style="font-size:50px"><span class="glyphicon glyphicon-fire"></span></p>
      <p><h5>Client</h5></p>    
      </div></a>
    </li>
    <li><a href="project">
      <div>
      <p style="font-size:50px"><i class="fa fa-fw"></i></p>
      <p><h5>Contract</h5></p>    
      </div></a>
    </li>
    <li><a href="site">
      <div>
      <p style="font-size:50px"><i class="fa fa-fw"></i></p>
      <p><h5>Client Site</h5></p>    
      </div></a>
    </li>   
    <li><a href="user">
      <div>
      <p style="font-size:50px"><i class="fa fa-fw"></i></p>
      <p><h5>Users</h5></p>    
      </div></a>
    </li>
    <li><a href="servicetype">
      <div>
      <p style="font-size:50px"><i class="fa fa-fw"></i></p>
      <p><h5>Service Type</h5></p>    
      </div></a>
    </li>
    <li><a href="category">
      <div>
      <p style="font-size:50px"><i class="fa fa-fw"></i></p>
      <p><h5>Category</h5></p>    
      </div></a>
    </li>   
    <li><a href="item">
      <div>
      <p style="font-size:50px"><i class="fa fa-fw"></i></p>
      <p><h5>Item</h5></p>    
      </div></a>
    </li>
    <li><a href="channel">
      <div>
      <p style="font-size:50px"><i class="fa fa-fw"></i></p>
      <p><h5>Report Channel</h5></p>    
      </div></a>
    </li>

    </ul>
  </div>        
            </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">
   // $('#div_app_list').load('app_list.php',function(responseTxt,statusTxt,xhr){
   //      // if(statusTxt=="success")             alert("External content loaded successfully!");
   //      if(statusTxt=="error")               alert("Error: "+xhr.status+": "+xhr.statusText);
   //  });
    // $('.bs-glyphicons li').click(function(){
    //   alert('header')
    // })

    </script>

<?
}else{
include ("../nav/access_denied.php");
}
include ("../nav/footer.php");
?>