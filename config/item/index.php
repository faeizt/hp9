<?php
session_start();
$_SESSION['nav_level'] = "2";
$_SESSION['nav_title'] = "config";
include ("../../nav/header.php");
if ($access_control2 == "true") {
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
                    <h1>Users <small>Maintenance Page</small></h1>
                    <ol class="breadcrumb">
                      <li ><a href="../../config"><i class="icon-cogs"></i> Configuration</a></li>
                      <li class="active"><i class="fa fa-fw"></i> Items</li>
                    </ol>
                  </div>
                </div><!-- /.row -->
                <div class="table-responsive" id="div_app_list"><?php
                            include '../../DB.php';

$sqlquery = "SELECT * FROM code_definition where code_cat='item' order by code desc";
$result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);          //query

$query = "SELECT COUNT(*) as num FROM code_definition where code_cat='item'";
$total_pages = mysqli_fetch_array(mysqli_query($con,$query));
$total_pages = $total_pages['num'];


$num  = mysqli_num_rows($result);

$i=0;?>
   <table id="datatables" class="ui-widget ui-widget-content table table-hover">
      <thead>
         <tr class="ui-widget-header ">
            <th style="width:50px">No</th>
            <th style="">Item Name</th>
            <th>Description</th>
<!--             <th style="width:50px">Action</th>
 -->         </tr>
      </thead>
      <tbody>

<?php
while ($row = mysqli_fetch_assoc($result)) {
  $id         =  $row["code_definition_id"];
  $code_cat   =  $row["code_cat"];
  $code       =  $row["code"];
  $code_name      =  $row["code_name"];
   $descr    =  $row["descr"];
  $i++;

  ?>
      <tr>
        <td style="width:15px"><?=$i?></td>
        <td><?=$code_name?></td>
        <td><?=$descr?></td>
<!--         <td style="width:50px">
          <font face="Arial" size="1">
            <a href="javascript:updateItem('<?=$id?>','<?=$code_cat?>','<?=$code?>','<?=$code_name?>','<?=$descr?>')" >
              <span style="cursor: pointer; cursor: hand;" class="ui-icon ui-icon-pencil"></span>
            </a>
            <a href="javascript:deleteItem('<?=$id?>')">
              <span style="cursor: pointer; cursor: hand;" class="ui-icon ui-icon-trash"></span>
            </a>
          </font>
        </td> -->
      </tr>
<?php 
} 

?>
      </tbody>
   </table>
               </div>
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

    </script>

<?php
}else{
include ("../../nav/access_denied.php");
}
include ("../../nav/footer.php");
?>