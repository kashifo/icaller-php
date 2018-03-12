<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

/*koderkashif@gmail.com 73849256
pmkashif@gmail.com
 
 * $mail->Username = "koderkashif@gmail.com";
$mail->Password = "73849256";
$mail->SetFrom("koderkashif@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("pmkashif@gmail.com");

 */
        
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "koderkashif@gmail.com";
$mail->Password = "73849256";
$mail->SetFrom("koderkashif@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("pmkashif@gmail.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }