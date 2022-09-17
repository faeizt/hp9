<?php
if(isset($_GET['user_id'])){
$user_id = $_GET['user_id'];
include '../../../DB.php';
$stmt ="SELECT ac.*,p.project_name FROM sys_user_ac ac,project p WHERE ac.project_code = p.project_code and user_id='$user_id' and ac.access !=0";
$result = mysqli_query($con,$stmt);          //query


while ($row=mysqli_fetch_array($result)) {
  $no         =  $row["id"];
  $access         =  $row["access"];
  $project_name       =  $row["project_name"];
  ?>
                    <li><a href="index.php?user_id=<?=$user_id?>&ac=<?=$no?>"><?=$project_name?> - <?=$access?></a></li>
<?php
} 
}
?>
