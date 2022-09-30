<?php
session_start();
if (!isset($_SESSION['username'])){
  header( 'Location: index.html' ) ;
}
include 'DB.php';

if(isset($_GET['projects'])){
  $projects = htmlspecialchars(urldecode($_GET['projects']));
}
$sqlquery = "SELECT * FROM v_incident WHERE project_code in ($projects) ORDER BY open_date desc LIMIT 0, 10";
// echo "sql = " .$sqlquery;

$result =   mysqli_query($con,$sqlquery) or die("sqlquery = ". $sqlquery);          //query
$i=0;
?>
<table id="tbl_application" class="table table-hover  tablesorter">
  <thead>
    <tr>
      <th style="width: 50px;">No </th>
      <th>Incident ID </th>
      <th>Problem </th>
      <th>Reported On </th>
      <th>Reporter </th>
      <th>Customer </th>
      <th>Assignee</th>
      <th>Status </th>
    </tr>
    </thead>
  <tbody>
<?php
  while($row = mysqli_fetch_array($result)){
      $i++;?>
    <tr style="border-bottom:1px solid #ddd" data="<?=$row['case_id']?>">
      <td><?=$i?></td>
      <td><?=$row['case_id']?></td>
      <td><?=$row['title']?></td>
      <td><?=$row['open_date']?></td>
      <td><?=$row['open_by']?></td>
      <td><?=$row['client_code']?></td>
      <td><?=$row['engineer_name']?></td>
      <td><?=$row['status']?></td>
    </tr>
<?php
  }
  ?>                      
  </tbody>
</table>


