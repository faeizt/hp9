<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 

  $result =  mysqli_query($con,"SELECT *  FROM sex");          //query
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