<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



require __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';


/**
 * @throws Exception
 */
function phpMailSender(string $email, string $type,  string $token = ''): bool
{
    // @ts-ignore
    $mail = new PHPMailer();                // @ignore
    $mail->CharSet    = 'UTF-8';
    $mail->Encoding   = 'base64';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    $mail->SMTPDebug = 0;                   // Enable verbose debug output
    $mail->isSMTP();                        // Set mailer to use SMTP
    $mail->Host       = config::$mail_host;    // Specify main SMTP server
    $mail->SMTPAuth   = true;               // Enable SMTP authentication
    $mail->Username   = config::$mail_user;     // SMTP username
    $mail->Password   = config::$mail_pass;         // SMTP password
    $mail->SMTPSecure = 'ssl';              // Enable TLS encryption, 'ssl' also accepted
    $mail->Port       = 465;                // TCP port to connect to
    $mail->setFrom('cow@newonline.world', 'noreply');
    $mail->addAddress($email);
    if($type === 'psw'){
        $mail->Subject = "Récupération de mot de passe COW";
        $mail->Body = makeMail($token);
    }
    if ($type === 'contact'){
        $mail->Subject = "Confirmation de la reception du ticket COW";
        //faire un body plus joli
        $mail->Body = 'Votre demande a bien été prise en compte, vous pouvez consulter son status dans la page contacte, ou par mail si vous ne pouvez pas vous connecter';
    }
    $mail->AltBody = "This is the plain text version of the email content";
    try {
        $mail->send();
        return true;
    } catch (Exception $e) {         // @ignore
        return false;
    }
}
function makeMail(string $token): string
{
    return '
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arima+Madurai">

<body style="background-color: #fff; margin: 0 !important; padding: 0 !important; font-family: Arima Madurai, sans-serif">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#C8EFFE" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                </tr>
            </table>
        </td>
    </tr>
    <td bgcolor="#C8EFFE" align="center" style="padding: 0 10px 0 10px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
            <tr>
                <td bgcolor="#ffffff" align="center" valign="top"
                    style="padding: 40px 20px 20px 20px; border-radius: 10px 10px 0 0; color: black; ">
                    <h1 style="font-size: 48px; font-weight: 400; margin: 2px;">Bonjour</h1></td>
            </tr>
        </table>
    </td>
    <tr>
    </tr>
    <tr>
        <td bgcolor="#C8EFFE" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="left"
                        style="padding: 20px 30px 40px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;">Veuillez cliquer sur ce bouton pour configurer un nouveau mot de passe :</p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="border-radius: 5px;" bgcolor="#ADE194"><a
                                                    href="https://newonline.world/login?page=newpassword&token=' . $token . '" target="_blank"
                                                style="font-size: 20px; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; display: inline-block;">Changer mon mot de passe</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
    <tr>
    </tr>
    </td>
    </tr>
    <td bgcolor="#C8EFFE" align="left" style="padding: 0px 30px 190px 30px; color: #666666; ">
    </td>
</table>

</body>';
}

