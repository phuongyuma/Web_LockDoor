<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'include/PHPMailer-master/src/Exception.php';
require 'include/PHPMailer-master/src/PHPMailer.php';
require 'include/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);
try {
<<<<<<< HEAD
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'manhhung20033004@gmail.com';
    $mail->Password   = 'ochp sdsd rnyd mndo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('manhhung20033004@gmail.com', 'WebLockDoor');
    $mail->addAddress('21522122@gm.uit.edu.vn', 'Admin of WebLockDoor');
=======
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
>>>>>>> b81c27dab0d4b4fa06958a0fc0ad213a5a9a869d

    $mail->isHTML(true);
    $mail->Subject = 'Alert for WebLockDoor';
    $mail->Body    = 'Someone is trying to open the door with wrong password';
    $mail->AltBody = 'Alert for WebLockDoor';

    $mail->send();
    echo 'Message has been sent';
<<<<<<< HEAD
    // echo "<script>window.location.href='admin.php'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
=======
    echo "<script>window.location.href='admin.php'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
>>>>>>> b81c27dab0d4b4fa06958a0fc0ad213a5a9a869d
