<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPmailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';
require 'PHPMailer\src\Exception.php';
$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'tindwahamadi@gmail.com';                     //SMTP username
    $mail->Password   = 'vqgo thlw eygc vjxx';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('tindwahamadi@gmail.com', 'BEST E-COMMERCE');
    $mail->addAddress($email);
    $mail->addReplyTo('tindwahamadi@gmail.com', 'Information');

    //Content
    $message = "Your New Password is <br> <h2>$code</h2>";
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'PASSWORD VERIFICATION';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
}
 catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>