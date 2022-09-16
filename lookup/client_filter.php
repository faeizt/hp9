<?php 
session_start();
include '../DB.php';
  $selected =   htmlspecialchars(trim($_GET['selected'])); 
  $code     =   htmlspecialchars(trim($_GET['code'])); 
  $user_id  =   $_SESSION['user_id'] ;
  $stmt     =   "SELECT * FROM sys_user_ac a, client c WHERE a.user_id='$user_id' AND a.client_code = c.client_code GROUP BY c.client_code;";
  $result   =   mysqli_query($con,$stmt) or die(mysqli_error($con)."\n".$stmt);          //query
// echo $stmt;
  $num    =   mysqli_num_rows($result);
  $i    = 0;
  if($num>1){?>
  <option></option>
  <?
  }
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["client_code"];
    $name    =  $row["name"];

    $i++;

    ?>
    <option value="<?=$id?>" <?if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>