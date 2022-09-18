<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 
  $result 	=  	mysqli_query($con,"SELECT *  FROM role where role_group = 'SAC'");          //query
  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;?><option></option>
<?php
  $access    = "";
  $access2    =  "";
  while ($row = mysqli_fetch_assoc($result)) {
    $name    =  $row["type"];
    $id 	 =  $row["role_id"];
    $access    =  $row["access"];
    $access2    =  $row["access2"];

    $i++;

    ?>
    <option value="<?=$id?>" access="<?=$access?>" access2="<?=$access2?>" <?if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>