<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'include/PHPMailer-master/src/Exception.php';
require 'include/PHPMailer-master/src/PHPMailer.php';
require 'include/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 2;                                 
    $mail->isSMTP();                                      
    $mail->Host       = 'smtp.gmail.com';                 
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'baophuongnguyen2626@gmail.com';            
    $mail->Password   = '<use a pass of app in this>';                   
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
    $mail->Port       = 587;                              

    $mail->setFrom('mail sent to', 'WebLockDoor');
    $mail->addAddress('<mail to sent>', 'Admin of WebLockDoor');

    $mail->isHTML(true);
    $mail->Subject = 'Alert for WebLockDoor';
    $mail->Body    = 'Someone is trying to open the door with wrong password';
    $mail->AltBody = 'Alert for WebLockDoor';

    $mail->send();
    echo 'Message has been sent';
    echo "<script>window.location.href='admin.php'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
