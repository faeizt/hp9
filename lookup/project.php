<?php 
include '../DB.php';
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 
  $client =   htmlspecialchars(trim($_GET['client'])); 

  if($client=="" || $client=="null") $result   =   mysqli_query($con,"SELECT *  FROM project");          //query
  else $result   =   mysqli_query($con,"SELECT *  FROM project where client_code = '$client'");
  $num  	= 	mysqli_num_rows($result);
  $i 		=	0;
  if($num>1){?>
  <option></option>
<?php
  }
  while ($row = mysqli_fetch_assoc($result)) {
    $id    =  $row["project_code"];
    $name 	 =  $row["project_name"];

    $i++;

    ?>
    <option value="<?=$id?>" <?php if($id==$selected){echo"selected";}?>><?=$name?></option><?php 
  } 

?>