<?php

$query = "select * from events ";
$res = mysqli_query($con,$query) or die(mysqli_error($con));
$events = array();
while ($row = mysqli_fetch_assoc($res)) {
    $start = "2010-01-08T08:30";//Here you have to format data from DB like this.
    $end = "2010-01-08T08:30";//This format works fine
    $title = $row['title'];
    $eventsArray['id'] =  $row['id'];
    $eventsArray['title'] = $title;
    $eventsArray['start'] = $start;
    $eventsArray['end'] = $end;
    $eventsArray['allDay'] = "";
    $events[] = $eventsArray;
}


echo json_encode($events);
?>