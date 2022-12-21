<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



require __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';


function phpMailSender($token, $email, $typeofemail)
{
    // @ts-ignore
    $mail = new PHPMailer();                // @ignore

    $mail->SMTPDebug = 0;                   // Enable verbose debug output
    $mail->isSMTP();                        // Set mailer to use SMTP
    $mail->Host       = 'ssl0.ovh.net;';    // Specify main SMTP server
    $mail->SMTPAuth   = true;               // Enable SMTP authentication
    $mail->Username   = 'mail';     // SMTP username
    $mail->Password   = 'mdp';         // SMTP password
    $mail->SMTPSecure = 'ssl';              // Enable TLS encryption, 'ssl' also accepted
    $mail->Port       = 465;                // TCP port to connect to
    $mail->setFrom('noreply@captair.paris', 'captair.paris noreply');
    $mail->addAddress($email);
    if ($typeofemail == 0) {
        $mail->Subject = "Confirmation de votre adresse mail sur captair.paris";
        $mail->Body = makemail($token);
        $mail->AltBody = "This is the plain text version of the email content";
    } else if ($typeofemail == 1) {
        $mail->Subject = "Changement de votre mot de passe captair.paris";
        $mail->Body = makemail($token);
        $mail->AltBody = "This is the plain text version of the email content";
    }
    try {
        $mail->send();
        echo "Message has been sent successfully";

        //connect to db and add usage of token (password reset/acc confirmation)


    } catch (Exception $e) {         // @ignore
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
function makemail($token){
    $stringData = '
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
    <style>
    
    img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
    }
    
    table {
        border-collapse: collapse !important;
        font-family: "Nunito Sans", sans-serif;
    }
    
    body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }
    </style>
    
    
    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td bgcolor="#00C4B3" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <td bgcolor="#00C4B3" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top"
                            style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; ">
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Bienvenue !</h1> <img </td>
                    </tr>
                </table>
            </td>
            <tr>
            </tr>
            <tr>
                <td bgcolor="#b4b4b4" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td bgcolor="#ffffff" align="left"
                                style="padding: 20px 30px 40px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Appuyez sur le bouton ci-dessous pour confirmer votre email :</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="center" style="border-radius: 3px;" bgcolor="#00C4B3"><a
                                                            href="' . "https://captair.paris/confirmation.php?token=$token".'" target="_blank"
                                                            style="font-size: 20px; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; display: inline-block;">Confirmer
                                                            le mail</a></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left"
                                style="padding: 0px 30px 0px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;">Si cela ne fonctionne pas, copiez et collez le lien suivant dans votre
                                    navigateur :</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left"
                                style="padding: 20px 30px 20px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                                <p style="margin: 0;"><a  target="_blank" href="' . "https://captair.paris/confirmation.php?token=$token".'"
                                        style="color: #00C4B3;">' . "https://captair.paris/confirmation.php?token=$token".'</a></p>
                            </td>
                        </tr>
                    </table>
            <tr>
            </tr>
            </td>
            </tr>
            <td bgcolor="#00C4B3" align="left" style="padding: 0px 30px 190px 30px; color: #666666; ">
            </td>
        </table>
    
    </body>';
    return $stringData;
}

