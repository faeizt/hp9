<?php
include '../DB.php';
if(isset($_GET['project_code'])){
	$project_code = $_GET['project_code'];
    $project_code = str_replace('\\', '', $project_code);
	$query = "SELECT id,owner,title,allday, DATE_FORMAT(begin,'%Y-%m-%d') beginallday, DATE_FORMAT(begin,'%Y-%m-%dT%H:%i') begin, DATE_FORMAT(end,'%Y-%m-%dT%H:%i') end FROM events  where owner in ($project_code)";
}
else $query = "select * from events ";
// echo $query;
$res = mysqli_query($con,$query) or die(mysqli_error($con));
$events = array();
while ($row = mysqli_fetch_assoc($res)) {
    // $start = "2014-01-08T08:30";//Here you have to format data from DB like this.
    // $end   = "2014-01-08T08:30";//This format works fine
    $title = $row['title'];
    $eventsArray['id'] =  $row['id'];
    $eventsArray['title'] = $title;
    if ($row['allday']=="true") {
	    $eventsArray['start'] = $row['beginallday'];
    }
    else $eventsArray['start'] = $row['begin'];
    if ($row['allday']=="false") {
	    $eventsArray['end'] = $row['end'];
	    $eventsArray['allDay'] = "";
    }
    $events[] = $eventsArray;
}


echo json_encode($events);
?>