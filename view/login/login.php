<div class="login">
    <h1>Connexion</h1>
    <form action="" method="post">
        <div class="input-container">
            <label for="username">
                Nom d'utilisateur
                <input type="text" name="username" autocomplete="off">
            </label>
        </div>
        <div class="input-container">
            <label for="password">
                Mot de passe
                <input type="password" name="password">
            </label>
        </div>
        <div class="lost-psw-container">
            <a href="./login?page=lostpassword">Mot de passe oublié ?</a>
        </div>
        <button type="submit" class="btn-green">
            <p>Entrer dans le site</p>
            <img src="./public/assets/icon/login.svg" alt="Enter icon">
        </button>
    </form>
</div>