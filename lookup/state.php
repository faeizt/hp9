<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 

  $result =  mysqli_query($con," SELECT code id,code_name name FROM code_definition WHERE code_cat='state'");          //query
  $num  = mysqli_num_rows($result);

  $i=0;?><?php
  while ($row = mysqli_fetch_assoc($result)) {
    $name    =  $row["name"];
    $id 	 =  $row["id"];
    $i++;

    ?>
    <option value="<?=$id?>" <?php if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>