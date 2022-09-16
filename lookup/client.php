<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 
  $result 	=  	mysqli_query($con,"SELECT *  FROM client");          //query
  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;?>
<option></option>
  <?
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["client_code"];
    $name 	 =  $row["name"];

    $i++;

    ?>
    <option value="<?=$id?>" <?if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>