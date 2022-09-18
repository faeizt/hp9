<?php
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "config";
include ("../../nav/header.php");
if ($access_control2 == "true") {
?>
      <!-- Submenu Navigation -->
      <nav class="navbar navbar-default" role="navigation">
      <div class="navbar-header visible-xs">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".submenu-colls">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>   
          <a class="navbar-brand" > <FONT color="3ca6fb">Submenu &nbsp;</FONT></a>

          </div>   
        <div id="myScrollspy" class="collapse navbar-collapse  submenu-colls">
          <ul class="nav navbar-nav-thin navbar-nav-leftborder-light vert-menu-border">
            <li><a href="new.php"><span class="glyphicon glyphicon-plus"></span> New Contract</a></li>
          </ul>          
        </div><!--/.nav-collapse -->
      </nav><!--/.navbar-default -->
      <!-- end of Submenu -->
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
                    <h1>Contract <small>Maintenance Page</small></h1>
                    <ol class="breadcrumb">
                      <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                      <li class=""><i class="fa fa-fw fa-briefcase "></i> Contract</li>
                    </ol>
                  </div>
                </div><!-- /.row -->
                <div class="table-responsive" id="div_app_list"><?php
            include '../../DB.php';

                  $sql="SELECT  project_code, project_name, project_descr, client_code,contract_code,accountmanager,projectmanager,clientpm,DATE_FORMAT(startdate,'%d/%m/%Y') startdate,DATE_FORMAT(enddate,'%d/%m/%Y') enddate FROM project";

                  $result = mysqli_query($con,$sql);          //query

                  $query = "SELECT COUNT(*) as num FROM project";
                  $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
                  $total_pages = $total_pages['num'];

                  // echo $sql;

                  $num  = mysqli_num_rows($result);

                  $i=0;?>
                    <table id="datatables" class="ui-widget ui-widget-content  table table-hover">
                      <thead>
                        <tr class="ui-widget-header ">
                          <th>No</th>
                          <th>Contract Code</th>
                          <th>Contract Name</th>
                          <th>Sales Order #</th>
                          <th>Account Manager</th>
<!--                           <th>Project Manager</th>
                          <th>Client Project Manager</th>
 -->                          <th>Start Date</th>
                          <th>End Date</th>       

                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                    $project_code       = $row["project_code"];
                    $project_name       = $row["project_name"];
                    $project_descr        = $row["project_descr"];
                    $project_client   = $row["client_code"];
                    $project_contractcode= $row["contract_code"];
                    $project_am       = $row["accountmanager"];
                    $project_pm       = $row["projectmanager"];
                    $project_cpm      = $row["clientpm"];
                    $project_startdate  = $row["startdate"];
                    $project_enddate    = $row["enddate"];



                    $i++;

                    ?>
                        <tr  data="<?=$project_code?>">
                          <td style="width:15px"><?=$i?></td>
                          <td><?=$project_code;?></td>
                              <td> 
                                    <b><a  rel="proj_popup" id="proj_popup" project_code = "<?=$project_code;?>" href="#" >
                                <?=$project_name;?>
                              </a></b></td>
                          <td><?=$project_contractcode?></td>
                          <td><?=$project_am?></td>
<!--                           <td><?=$project_pm?></td>
                          <td><?=$project_cpm?></td>
 -->                          <td><?=$project_startdate?></td>
                          <td><?=$project_enddate?></td>
                        </tr>
                  <?php 
                  } 
// echo "i=".$i;
                  ?>
                        </tbody>
                        
                     </table>            </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">
      $(document).ready(function(){
        // $('#datatables').dataTable();
        var dTable=$("#datatables").dataTable({
          "bProcessing":false,
          "bPaginate":true,
          "bRetrieve":false,
          "bFilter":true,
          "bJQueryUI":true,
          "bAutoWidth":false,
          "bInfo":true,
          "fnPreDrawCallback":function(){
              $("#datatables").hide();
              // $("#loading").show();
              // alert("Pre Draw");
          },
          "fnDrawCallback":function(){
              $("#datatables").show();
              
              // $("#loading").hide();
              // alert("Draw");
          },
          "fnInitComplete":function(){
              // alert("Complete");
              $("#datatables").show();
          }
        })              })
      $(document).on('click', '#datatables tbody tr', function(){
                  window.location.href = "view.php?project_code="+$(this).attr('data');
            });


    </script>

<?php
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>