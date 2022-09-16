<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 
  $specialization_current = "";

  if ($selected!="") $result   =   mysqli_query($con,"SELECT user_id id,NAME FROM sys_users where specialization='$selected'");          //query
  else $result   =   mysqli_query($con,"SELECT id,NAME,specialization FROM v_user ");          //query

  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;?>
  <option></option>
  <?php
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["id"];
    $name 	 =  $row["NAME"];
    $specialization    =  $row["specialization"];

    $i++;
    if ($specialization != $specialization_current) {$specialization_current=$specialization;?>
      <optgroup label="<?=$specialization?>"  ><?
    }
    ?>

    <option value="<?=$id?>" <?if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
          if ($client != $client_current) {?>
      </optgroup><?
    }
  } 

?>

