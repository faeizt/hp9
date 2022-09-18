<?php
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "inventory";
include ("../nav/header.php");
if ($access_control == "true") {
?>
      <!-- Submenu Navigation -->
      <nav class="navbar navbar-default " role="navigation">
      <div class="navbar-header visible-xs">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".submenu-colls">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>   
          <a class="navbar-brand  navbar-brand-thin " > <FONT color="3ca6fb">Submenu &nbsp;</FONT></a>

          </div>   
        <div id="myScrollspy" class="collapse navbar-collapse  submenu-colls">
          <ul class="nav navbar-nav-thin navbar-nav-leftborder-light vert-menu-border">
            <li><a href="machine"><span class="glyphicon glyphicon-file"></span> Machine Type</a></li>
            <li><a href="new.php"><span class="glyphicon glyphicon-plus"></span> Add Product List</a></li>
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
                      <li class="active"><i class="fa fa-inbox"></i> Product List</li>
                      
                    </ol>
                  </div>
                </div><!-- /.row -->
                <div class="table-responsive" id="div_app_list">              
<?php
                include '../DB.php';
                $sqlquery = "SELECT * FROM v_inventory order by id desc";
                $result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query

                $query = "SELECT COUNT(*) as num FROM v_inventory";
                $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
                $total_pages = $total_pages['num'];


                $num  = mysqli_num_rows($result);

                $i=0;?>
                   <table id="datatables" class="ui-widget ui-widget-content  table table-hover">
                      <thead>
                      <tr>
                        <th style="width: 50px;">No </th>
                        <th>Machine Type</th>
                        <th>Serial Number </th>
                        <th>Contract </th>
                      </tr>
                      </thead>
                    <tbody>
                    <?php
                    while($row = mysqli_fetch_array($result)){
                        $i++;
                        echo      "<tr data=". $row['id']."><td>".$i."</td>";?>
                        <td><?=$row['machine_type']?></td>
                        <td><?=$row['sn']?></td>
                        <td><?=$row['project_name']?></td>                        


                        </tr><?php
                    }
                    ?>                      

                    </tbody>
                   </table>
                </div>
            </div>
      </div><!-- /#page-wrapper -->


    <script type="text/javascript">
   // $('#div_app_list').load('app_list.php',function(responseTxt,statusTxt,xhr){
   //      // if(statusTxt=="success")             alert("External content loaded successfully!");
   //      if(statusTxt=="error")               alert("Error: "+xhr.status+": "+xhr.statusText);
   //  });
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
        })        
      })
      $(document).on('click', '#datatables tbody tr', function(){
            window.location.replace("view.php?id="+$(this).attr('data'));
      });
    </script>

<?php
}else{
include ("../nav/access_denied.php");
}
include ("../nav/footer.php");
?>