i<?php
include 'includes/mail.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $mail_username;
    $mail->Password = $mail_password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom($mail_username, 'CoreCrest HR');
    $mail->addAddress('corecrest15@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'CoreCrest Test Mail';
    $mail->Body = '<h2>Test mail working</h2>';

    $mail->send();
    echo "Mail sent successfully";
} catch (Exception $e) {
    echo "Mail failed: " . $mail->ErrorInfo;
}
