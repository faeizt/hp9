<?
$caseid = "LHDN020030214";
$len    = strlen($caseid);
$end	= $len-7;
echo $len. " - " . $end."<br/>";
// echo substr($caseid,0,$end)."<br>";
echo substr($caseid,0,-1)."<br>"
?>