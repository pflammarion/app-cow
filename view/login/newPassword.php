<div class="new-password">
    <h1>Réinitialisation de mon mot de passe</h1>
    <form action="" method="post">
        <div class="input-container">
            <label for="password">
                Mot de passe
                <input id="password" type="password" name="password" required="required">
            </label>
        </div>
        <div class="input-container">
            <label for="password_confirm">
                Confirmation du mot de passe
                <input id="password_confirm" type="password" name="password_confirm" required="required">
            </label>
        </div>
        <input type="hidden" value="<?php echo htmlspecialchars( $_GET['token'])?>" name="token">
        <button type="submit" class="btn-green">
            <p>Valider</p>
        </button>
    </form>
</div>
