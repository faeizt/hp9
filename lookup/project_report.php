<?php 
session_start();

include '../DB.php';
  $code=0;

  $selected =   htmlspecialchars(trim($_GET['selected'])); 
  $client_current = "";
  $code = htmlspecialchars(trim($_GET['code'])); 
  $user_id =   $_SESSION['user_id'] ;
  $sql = 'ayam goeren';

  $result   =   mysqli_query($con,"SELECT *  FROM sys_user_ac a, v_project p WHERE a.user_id='$user_id' AND a.project_code = p.project_code AND a.access & 8192 = 8192  ORDER BY p.client_code");          //query
  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;
  if($num>1){?>
  <option></option>
  <?php
  }
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["project_code"];
    $project_name 	 =  $row["project_name"];
    $client    =  $row["client_code"];
    $name    =  $row["name"];

    $i++;
    if ($client != $client_current) {$client_current=$client;?>
      <optgroup label="<?=$client?>" data-subtext="<?=$name?>" >
      <?php
    }
    ?>
    <option value="<?=$id?>" <?php if($id==$selected){echo"selected";}?>><?=$project_name?></option><?php 
        if ($client != $client_current) {?>
      </optgroup><?php
    }
    } 

?>