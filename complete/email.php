<?php

session_start();
$to = $_SESSION['customer_email'];
$subject = "Thank you for your Donation";

ob_start();
include("onceoffemail.php");
$message = ob_get_contents();
ob_end_clean();

//$message = "What The " . $_SESSION['customer_email'];


// Always set content-type when sending HTML email

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset="utf-8"' . "\r\n";

// More headers
$headers .= 'From: <noreply@pmnts.io>' . "\r\n";

mail($to,$subject,$message,$headers);

echo $message;
print_r(error_get_last());

?>