<?
require ('notification.php');
 
$notifications = new notification();
 	$id = $_POST['id'];
    $notifications->updateNotification($id);
?>