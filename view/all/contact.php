<div class="contact">
    <h1>Contact</h1>
    <div class="container">
        <h2>Liste des tickets</h2>
        <div class="list">
            <?php ?>
        </div>
        <span class="separator"></span>
        <h2>Nous contacter</h2>
        <form action="" method="post">
            <label for="email">
                Email
                <input id="email" type="email" name="email" required="required">
            </label>
            <label for="tag">
                Sujet
                <select name="tag">
                    <option>Choisir votre demande</option>
                    <?php ?>
                </select>
            </label>
            <label for="content">
                Votre message
                <textarea id="content" name="content" required="required"></textarea>
            </label>

            <button type="submit" class="btn-green">
                Je crée mon profil
                <img src="./public/assets/icon/login.svg" alt="Enter icon">
            </button>
        </form>
        <span class="separator"></span>
        <h2>Contact téléphonique</h2>
        <p>+33 X XX XX XX XX</p>
    </div>
</div>
