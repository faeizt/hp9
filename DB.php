<?php


$host = "localhost";
$user = "helpdeskadmin";
$pass = "E8s*aq56^tye945-";
$port = "3306";
$socket = null;
$databaseName = "thehelpdesk";

  $con = mysqli_connect($host,$user,$pass,$databaseName,$port,$socket);
  $dbs = mysqli_select_db($con,$databaseName);
?>