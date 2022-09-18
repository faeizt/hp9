<?php 
session_start();

include '../DB.php';
  $code=0;
  $selected	=   htmlspecialchars(trim($_GET['selected'])); 
  $client =   htmlspecialchars(trim($_GET['client'])); 
  $code = htmlspecialchars(trim($_GET['code'])); 
  $user_id =   $_SESSION['user_id'] ;
  $sql = 'ayam goeren';
  if($client=="" || $client=="null") {
    $sql = "SELECT * FROM sys_user_ac a, project p WHERE a.user_id='$user_id' AND a.project_code = p.project_code AND a.access & $code = $code";          //query
  }
  else {
   $sql   = "SELECT * FROM sys_user_ac a, project p WHERE a.user_id='$user_id' AND a.project_code = p.project_code AND a.access & $code = $code and a.client_code = '$client'"; 
  }
  // echo $sql;
  $result =   mysqli_query($con,$sql);
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