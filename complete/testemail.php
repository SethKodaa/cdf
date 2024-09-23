<?php
$to = "mike@fatzebra.com.au";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: receipts@cdfpay.org.au" . "\r\n" .
"CC: michael.smith@paystream.com.au";

mail($to,$subject,$txt,$headers);
?>