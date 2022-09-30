<?php
session_start();
$_SESSION['nav_level'] = "1";
$_SESSION['nav_title'] = "incident";     
include '../DB.php';

if(isset($_POST['fltr']) && ($_POST['fltr']!='')){
  $fltr = $_POST['fltr'];
  $fltr = str_replace("^", "'", $fltr);
  $sqlquery = "SELECT * FROM v_incident where ".$fltr." order by open_date desc";                
}     
if (isset($_GET['projects']) ) {
  $project_code=$_GET['projects'];
  $sqlquery = "SELECT * FROM v_incident where project_code in ($project_code) order by open_date desc";   
}            
// echo $sqlquery;
$result = mysqli_query($con,$sqlquery) or die("sql= ". $sqlquery);    
$num  = mysqli_num_rows($result);
$i=0;?>
<table id="datatables" class="ui-widget ui-widget-content  table table-hover">
  <thead>
    <tr>
      <th style="width: 50px;">No </th>
      <th>Incident ID </th>
      <th>Contact Person </th>
      <th>Contact Number </th>
      <th>Problem Title </th>
      <th>Channel </th>
      <th>Incident category </th>
      <th>Issue Category </th>
      <th>Model </th>
      <th>Assign To </th>
      <th>Status </th>
      <th>Created </th>
      <th>Created By</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($row = mysqli_fetch_array($result)){
    $i++;
    echo "<tr data=". $row['case_id']."><td>".$i."</td>";?>
    <td><?=$row['case_id']?></td>                        
    <td><?=$row['caller']?></td>
    <td><?=$row['contact']?></td>
    <td><?=$row['title']?></td>
    <td><?=$row['viaDesc']?></td>
    <td><?=$row['typeDesc']?></td>
    <td><?=$row['catDesc']?></td>
    <td><?=$row['model']?></td>
    <td><?=$row['engineer_name']?></td>
    <td><?=$row['status']?></td>
    <td><?=$row['open_date']?></td>
    <td><?=$row['open_by']?></td>
    </tr><?php
  }
  ?>                      
  </tbody>
</table>
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
  })        
})
$(document).on('click', '#datatables tbody tr', function(){
  window.location.href = "view.php?app_no="+$(this).attr('data');
});
</script>
<?php 
include ("../nav/footer.php");
?>