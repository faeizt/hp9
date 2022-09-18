<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 

  if ($selected!="") $result   =   mysqli_query($con,"SELECT user_id id,name FROM sys_users where specialization='$selected'");          //query
  else $result   =   mysqli_query($con,"SELECT user_id id,name FROM sys_users ");          //query
  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;?>
  <option></option>
  <?php
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["id"];
    $name 	 =  $row["name"];

    $i++;
echo "NAME=". $name;
    ?>
    <option value="<?=$id?>" <?if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>