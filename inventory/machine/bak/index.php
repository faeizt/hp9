<?
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "inventory";
include ("../../nav/header.php");
if ($access_control == "true") {
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
            <li><a href="new.php"><span class="glyphicon glyphicon-plus"></span> New Machine</a></li>
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
                    <ol class="breadcrumb">
                      <li ><a href="../../inventory"><i class="fa fa-inbox"></i> Product List</a></li>
                      <li class=""><i class="fa fa-fw fa-cog "></i> Machine</li>
                    </ol>
                  </div>
                </div><!-- /.row -->
                <div class="table-responsive" id="div_app_list"><?
            include '../../DB.php';

                  $sql="SELECT * FROM product p LEFT JOIN project j ON j.project_code = p.project_code ORDER BY product_id DESC";

                  $result = mysqli_query($con,$sql);          //query

                  $query = "SELECT COUNT(*) as num FROM product";
                  $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
                  $total_pages = $total_pages['num'];

                  // echo $sql;

                  $num  = mysqli_num_rows($result);

                  $i=0;?>
                    <table id="datatables" class="ui-widget ui-widget-content  table table-hover">
                      <thead>
                        <tr class="ui-widget-header ">
                          <th>No</th>
                          <th>client </th>
                          <th>Contract</th>
                          <th>Machine Type</th>
                          <th>Brand</th>
                          <th>Model</th>
                          <th>Spec</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?
                  while ($row = mysqli_fetch_assoc($result)) {
                    $id           = $row["product_id"];
                    $client           = $row["client_code"];
                    $project          = $row["project_name"];
                    $product          = $row["product_type"];
                    $brand            = $row["brand"];
                    $model            = $row["model"];
                    $spec             = $row["spec"];
                    $i++;

                    ?>
                        <tr  data="<?=$id?>">
                          <td style="width:15px"><?=$i?></td>
                          <td><?=$client;?></td>
                          <td><?=$project;?></td>
                          <td><?=$product?></td>
                          <td><?=$brand?></td>
                          <td><?=$model?></td>
                          <td><?=$spec?></td>
                        </tr>
                  <?php 
                  } 

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
                  window.location.replace("view.php?product_id="+$(this).attr('data'));
            });


    </script>

<?
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>