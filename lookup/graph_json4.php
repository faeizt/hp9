<?php
$someWords = "LHDN02,MARA01";
$wordChunks = explode(",", $someWords);
for($i = 0; $i < count($wordChunks); $i++){
	echo $wordChunks[$i];
}
?>