<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';


/**
 * @throws Exception
 **/
if (isset($_POST["Envoyer"])) {
    // @ts-ignore
    $mail = new PHPMailer();                // @ignore
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    $mail->SMTPDebug = 0;                   // Enable verbose debug output
    $mail->isSMTP();                        // Set mailer to use SMTP
    $mail->Host = 'ssl0.ovh.net';    // Specify main SMTP server
    $mail->SMTPAuth = true;               // Enable SMTP authentication
    $mail->Username = 'cow@newonline.world';     // SMTP username
    $mail->Password = "Let'sCodeAPP";         // SMTP password
    $mail->SMTPSecure = 'ssl';              // Enable TLS encryption, 'ssl' also accepted
    $mail->Port = 465;                // TCP port to connect to

    $mail->setFrom('cow@newonline.world', 'noreply');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    $mail->Subject = $_POST["sujet"];
    $mail->Body = $_POST["message"];
}
try {
    $mail->send();
    return true;
} catch (Exception $e) {         // @ignore
    return false;
}