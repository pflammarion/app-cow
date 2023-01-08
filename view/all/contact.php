<div class="contact">
    <h1>Contact</h1>
    <div class="contact-article">
        <div class="contacter">
            <h2>Nous contacter</h2>
            <form action="" method="get" class="form">
                <div class="email-sujet">
                    <p><label for="email">Votre adresse email :</label>
                        <input type="email" name="email" id="box" placeholder="nom@gmail.com" size="33" maxlength="50" />
                    </p>

                    <p><label for="sujet">Sujet :</label>

                        <select name="sujet" id="box">
                            <option value="">--Choisir votre demande--</option>
                            <option value="Bug informatique">bug informatique</option>
                            <option value="Problème materiel">problème materiel</option>
                            <option value="Demande d'informations">demande d'informations</option>
                        </select></p>
                </div>
                <p><label for="message">Votre message :</label>
                <textarea name="message" placeholder="Message" class="required"></textarea>
                </p>
                <div class="caracteres"><p>1000 caractères max</p></div>
                    <input type="submit" value="Envoyer">
            </form>
        </div>
        <span class="separator"></span>
        <div class="telephone">
            <h2>Contact téléphonique</h2>
            <p>06 54 32 10 69<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.</p>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        <?php

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
        require __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';


        /**
         * @throws Exception
         **/
            if(isset($_POST["Envoyer"])) {
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
            }
            catch (Exception $e) {         // @ignore
                return false;
            }?>
</script>

