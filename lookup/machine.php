

<?php 
include '../DB.php';
  $project  =   "";
  $selected =   "";
  if (isset($_GET['project'])) {
    $project  =  htmlspecialchars(trim($_GET['project']));
  }
  if (isset($_GET['selected'])) {
    $selected =   htmlspecialchars(trim($_GET['selected'])); 
  }
  $query    =   "SELECT product_id, CONCAT(`product_type`,' ',`brand`,' ', `model`) machine_type FROM product WHERE project_code = '$project' ";
  if ($selected !="" && $project =="") {
    $query    =   "SELECT product_id, CONCAT(`product_type`,' ',`brand`,' ', `model`) machine_type FROM product where project_code = '$selected'";
  }
  if ($selected =="" && $project =="") {
    $query    =   "SELECT product_id, CONCAT(`product_type`,' ',`brand`,' ', `model`) machine_type FROM product";
  }
  echo $query;
  $result 	=  	mysqli_query($con,$query);          //query
  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;  
  if($num>1){?>
  <option></option>
<?php
  }
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["product_id"];
    $name 	 =  $row["machine_type"];

    $i++;

    ?>
    <option value="<?=$id?>" <?if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>