<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 
  $result 	=  	mysqli_query($con,"SELECT *  FROM specialization");          //query
  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;?>
  <option></option>
<?php
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["id"];
    $name 	 =  $row["name"];

    $i++;

    ?>
    <option value="<?=$id?>" <?php if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>