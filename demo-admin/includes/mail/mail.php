<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->Port = 587; 
$mail->SMTPSecure = 'tls'; 
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'sulehry888@gmail.com';                 // SMTP username
$mail->Password = 'Sajjad88';                           // SMTP password
                           // Enable TLS encryption, `ssl` also accepted
                                   // TCP port to connect to

$mail->setFrom('sulehry888@gmail.com', 'Mailer');
$mail->addAddress('sulehry888@gmail.com', 'Joe User');     // Add a recipient
              // Name is optional
$mail->addReplyTo('01113003065072@SKT.UMT.EDU.PK', 'Information');

                                // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}