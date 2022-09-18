

<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 
  $result 	=  	mysqli_query($con,"SELECT  CODE,code_name FROM code_definition WHERE code_cat = 'servicetyp'");          //query
  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;?>
<option></option>
<?php
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["CODE"];
    $name 	 =  $row["code_name"];

    $i++;

    ?>
    <option value="<?=$id?>" <?if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>