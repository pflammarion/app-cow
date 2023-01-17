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
    switch ($type){
        case 'register':
            $mail->Subject = "Validation de l'adresse email COW";
            $content = 'Veuillez cliquer sur ce bouton pour valider la création de votre compte';
            $link = 'https://newonline.world/login?page=emailvalidate&token=' . $token;
            $link_text = 'Valider mon compte';
            $mail->Body = makeMail($content, $link, $link_text);
            $mail->AltBody = "Veuillez cliquer sur ce bouton pour valider la création de votre compte : " . $link;
            break;
        case 'psw':
            $mail->Subject = "Récupération de mot de passe COW";
            $content = 'Veuillez cliquer sur ce bouton pour configurer un nouveau mot de passe :';
            $link = 'https://newonline.world/login?page=newpassword&token=' . $token;
            $link_text = 'Changer mon mot de passe';
            $mail->Body = makeMail($content, $link, $link_text);
            $mail->AltBody = "Pour changer de mot de passe merci de cliquer sur ce lien : " . $link;
            break;
        case 'creation':
            $mail->Subject = "Création de votre compte COW";
            $content = 'Veuillez cliquer sur ce bouton pour configurer votre nouveau mot de passe :';
            $link = 'https://newonline.world/login?page=newpassword&token=' . $token;
            $link_text = 'Créer mon mot de passe';
            $mail->Body = makeMail($content, $link, $link_text);
            $mail->AltBody = "Pour créer votre mot de passe merci de cliquer sur ce lien : " . $link;
            break;
        case 'update':
            $mail->Subject = "Mise à jour de votre compte COW";
            $content = 'Un administrateur a mis à jour votre compte, pour aller sur l\'application, vous pouvez cliquer sur ce lien :';
            $link = 'https://newonline.world';
            $link_text = 'Application COW';
            $mail->Body = makeMail($content, $link, $link_text);
            $mail->AltBody = "Un administrateur a mis à jour votre compte, pour aller sur l'application, vous pouvez cliquer sur ce lien : " . $link;
            break;
        case 'delete':
            $mail->Subject = "Suppression de votre compte COW";
            $content = 'Un administrateur a supprimé votre compte, pour contacter un administrateur, vous pouvez cliquer sur ce lien :';
            $link = 'https://newonline.world/all?page=contact';
            $link_text = 'Contacter un admin';
            $mail->Body = makeMail($content, $link, $link_text);
            $mail->AltBody = "Un administrateur a supprimé votre compte, pour contacter un administrateur, vous pouvez cliquer sur ce lien : " . $link;
            break;
        case 'ban':
            $mail->Subject = "Bannissement de votre compte COW";
            $content = 'Un administrateur a banni votre compte, pour contacter un administrateur, vous pouvez cliquer sur ce lien :';
            $link = 'https://newonline.world/all?page=contact';
            $link_text = 'Contacter un admin';
            $mail->Body = makeMail($content, $link, $link_text);
            $mail->AltBody = "Un administrateur a banni votre compte, pour contacter un administrateur, vous pouvez cliquer sur ce lien : " . $link;
            break;
        case 'contact':
            $mail->Subject = "Confirmation de la reception du ticket COW";
            $content = 'Votre demande a bien été prise en compte, vous pouvez consulter le status de votre demande dans la page contact, ou vous serez contacté par mail si vous ne pouvez pas vous connecter.';
            $link = 'https://newonline.world/all?page=contact&isconnected=1';
            $link_text = 'Voir mes tickets';
            $mail->Body = makeMail($content, $link, $link_text);
            $mail->AltBody = "Votre ticket a bien été envoyé, vous pouvez le voir à cette adresse : " . $link;
            break;
        case 'contact_update':
            $mail->Subject = "Changement de status du ticket COW";
            $content = "L'un de vos tickets a changé de status à l'instant, vous pouvez retrouver tous vos tickets ici :";
            $link = 'https://newonline.world/all?page=contact&isconnected=1';
            $link_text = 'Voir mes tickets';
            $mail->Body = makeMail($content, $link, $link_text);
            $mail->AltBody = "Votre ticket a changé de statut à l'instant " . $link;
            break;
    }
    try {
        return $mail->send();
    } catch (Exception $e) {         // @ignore
        return false;
    }
}
function makeMail(string $content, string $link, string $link_text): string
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
                        <p style="margin: 0;">'. $content .'</p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <td align="center" style="border-radius: 5px;" bgcolor="#ADE194"><a
                                                    href="' . $link .'" target="_blank"
                                                style="font-size: 20px; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; display: inline-block;">' . $link_text . '</a></td>
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

