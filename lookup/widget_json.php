<?php
include '../DB.php';
$project    		= htmlspecialchars(trim($_GET['project_code']));
$begin	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['begin'])));
$end	    		= mysqli_real_escape_string($con,htmlspecialchars(trim($_GET['end'])));
$project 			= str_replace('\\', '', $project);
$h = array();
$v = array();
$words = "open,inprogress,waiting,asdfa,asdf,sf5";
$wordsplit = explode(",", $words);

$someWords = "0,1,2,3,4,5";
$wordChunks = explode(",", $someWords);
for($j = 0; $j < count($wordChunks); $j++){

$open = "SELECT COUNT(*) open FROM cases WHERE project_code in ($project) and sts = $wordChunks[$j];";
//  echo $open;
$q = mysqli_query($con,$open)or die(mysqli_error($con));
$r = mysqli_fetch_array($q) ;
array_push($v,array($wordsplit[$j]=>$r['open']));
}

print_r( json_encode($v) );

?>