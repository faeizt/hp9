<?php
 
require ('notification.php');
 
$notifications = new notification();
 
    global $notifications;
	$subject_id =    $notifications->getSubject('assign','UTM010010314');
    $notifications->sendNotification($subject_id);
 
?>