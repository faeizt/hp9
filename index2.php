<?php

date_default_timezone_set('Asia/Kuala_Lumpur');
$first_day_this_month = date('Y-01-01'); // hard-coded '01' for first day
$last_day_this_month  = date('Y-12-t');

$date = date("Y-m-d");
$year = date("Y");
?>
<input type="hidden" id="today" value="<?$date?>">

<?php
session_start();
$_SESSION['nav_level'] = "0";
$_SESSION['nav_title'] = "dashboard";

include ("nav/header.php");
if ($access_control == "true") {
   echo "access granted";
}else{
include ("nav/access_denied.php");
}
include ("nav/footer.php");
?>

