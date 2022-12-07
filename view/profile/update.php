<?php $data = $content ?? []; ?>
<div class="profil-update">
    <div class="container">
        <form action="" method="post">
            <div class="input-container">
                <label for="lastename">
                    Nom
                    <input value="<?php echo $data['lastname']?>" type="text" name="lastename">
                </label>
            </div>
            <div class="input-container">
                <label for="firstname">
                    Prénom
                    <input value="<?php echo $data['firstname']?>" type="text" name="firstname">
                </label>
            </div>
            <div class="input-container">
                <label for="username">
                    Nom d'utilisateur
                    <input value="<?php echo $data['username']?>" type="text" name="username">
                </label>
            </div>
            <div class="input-container">
                <label for="email">
                    Adresse email
                    <input value="<?php echo $data['email']?>" type="email" name="email">
                </label>
            </div>
            <?php
            if(!is_null($data['img_url'])){
                echo '<img src="' . $data['img_url'] . '" class="profil-img">';
            }
            else echo '<a href="profil?action=update" class="img-link"><img src="./public/assets/icon/profile.svg" class="profil-img"></a>'
            ?>
            <button type="submit" class="btn-green">Enregistrer</button>
        </form>
    </div>
</div>