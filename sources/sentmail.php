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
    $mail->Username   = 'manhhung20033004@gmail.com';
    $mail->Password   = 'Enter your key ';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('email from', 'WebLockDoor');
    $mail->addAddress('email admin', 'Admin of WebLockDoor');

    $mail->isHTML(true);
    $mail->Subject = 'Alert for WebLockDoor';
    $mail->Body    = 'Someone is trying to open the door with wrong password';
    $mail->AltBody = 'Alert for WebLockDoor';

    $mail->send();
    echo 'Message has been sent';
    // echo "<script>window.location.href='admin.php'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}