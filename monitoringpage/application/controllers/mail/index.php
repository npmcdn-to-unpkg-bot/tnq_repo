<?php
   require("PHPMailerAutoload.php"); // path to the PHPMailerAutoload.php file.
 
   $mail = new PHPMailer();
   $mail->IsSMTP();
   $mail->Mailer = "smtp";
   $mail->Host = "ssl://smtp.gmail.com";
   $mail->Port = "465"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = 'tls';
   $mail->Username = "pcapptest@tnqsoftware.co.in";
   $mail->Password = "wVp7vSQVB";
    
   $mail->From     = "pcapptest@tnqsoftware.co.in";
   $mail->FromName = "Raja";
   $mail->AddAddress("meenaraja@tnqsoftware.co.in","Raja");
   $mail->AddReplyTo("meenaraja@tnqsoftware.co.in", "Raja");
 
   $mail->Subject  = "Hi!";
   $mail->Body     = "dfa";
   $mail->WordWrap = 50;  
 
   if(!$mail->Send()) {
		echo 'Message was not sent.';
		echo 'Mailer error: ' . $mail->ErrorInfo;
		exit;
   } else {
		echo 'Message has been sent.';
   }
