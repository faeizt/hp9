<?php

//--------------------------------------------------------------------------
// Example php script for fetching data from mysql database
//--------------------------------------------------------------------------
$host = "localhost";
$user = "root";
$pass = "";
$port = "3308";
$socket = null;
$databaseName = "thehelpdesk";

  $con = mysqli_connect($host,$user,$pass,$databaseName,$port,$socket);
  $dbs = mysqli_select_db($con,$databaseName);
?>