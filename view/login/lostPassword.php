<div class="lostpsw">
    <h1>Vous avez perdu votre mot de passe ?</h1>
    <h2>Pas de panique !</h2>
    <form action="" method="post">
        <div class="input-container">
            <label for="email">
                Adresse email
                <input type="email" name="email">
            </label>
        </div>
        <button type="submit" class="btn-green">
            <p>Recevoir par email</p>
            <img src="./public/assets/icon/mail.svg" alt="Enter icon">
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

        $('button').on('click', function (e){
            e.preventDefault();
            $("#overlay").fadeIn(300);
            $('form').submit();
        })

    });
</script>
