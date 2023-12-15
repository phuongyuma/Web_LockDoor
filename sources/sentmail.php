<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'include/PHPMailer-master/src/Exception.php';
require 'include/PHPMailer-master/src/PHPMailer.php';
require 'include/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'manhhung20033004@gmail.com';
    $mail->Password   = 'ochp sdsd rnyd mndo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('manhhung20033004@gmail.com', 'WebLockDoor');
    $mail->addAddress('21522122@gm.uit.edu.vn', 'Admin of WebLockDoor');

    $mail->isHTML(true);
    $mail->Subject = 'Alert for WebLockDoor';
    $mail->Body    = 'Someone is trying to open the door with wrong password';
    $mail->AltBody = 'Alert for WebLockDoor';

    $mail->send();
    // echo 'Message has been sent';
    // echo "<script>window.location.href='admin.php'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}