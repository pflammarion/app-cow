<div class="register">
    <h1>Pas encore de compte ?</h1>
    <form id="register-form" action="" method="post">
        <div class="input-container">
            <label for="lastname">
                Nom
                <input id="lastname" type="text" name="lastname" required="required">
            </label>
        </div>
        <div class="input-container">
            <label for="firstname">
                Prénom
                <input id="firstname" type="text" name="firstname" required="required">
            </label>
        </div>
        <div class="input-container">
            <label for="username">
                Nom d'utilisateur
                <input id="username" type="text" name="username" autocapitalize="off" required="required">
            </label>
        </div>
        <div class="input-container">
            <label for="email">
                Adresse email
                <input id="email" type="email" name="email" required="required">
            </label>
        </div>
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
        <button id="env" type="submit" class="btn-green">
            <p>Je crée mon profil</p>
            <img src="./public/assets/icon/login.svg" alt="Enter icon">
        </button>
    </form>
</div>
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>

<script>
    $(document).ready(() => {

        $('#env').on('click', function (e){
            e.preventDefault();
            $("#overlay").fadeIn(300);
            $('form').submit();
        })
    });
</script>
