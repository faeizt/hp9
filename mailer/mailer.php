<?   $to = "silverbolt842000@gmail.com";
   $subject = "New ticket has been issued & assigned to you";
   $message = "Hello ";
   $from = "admin@fnshelpdesk.net";
   $headers = "From:" . $from;
   mail($to,$subject,$message,$headers);
?>