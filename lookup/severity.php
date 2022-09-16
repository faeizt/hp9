

<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 
  $sla            = htmlspecialchars(trim($_GET['sla']));
  $result 	=  	mysqli_query($con,"SELECT severitylevel , code_name FROM severity LEFT JOIN code_definition ON severitylevel=CODE AND code_cat = 'flag' WHERE sla = '$sla' ");          //query
  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;?>
<option></option>
  <?
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["severitylevel"];
    $name 	 =  $row["code_name"];

    $i++;

    ?>
    <option value="<?=$id?>" <?if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>