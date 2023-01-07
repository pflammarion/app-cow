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
                            <option value="bug informatique">bug informatique</option>
                            <option value="problème materiel">problème materiel</option>
                            <option value="demande d'informations">demande d'informations</option>
                        </select></p>
                </div>
                <?php
                $message = wordwrap($message, 70, "\r\n");
                ?>
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

