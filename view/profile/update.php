<?php $data = $content ?? []; ?>
<div class="profil-update">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input-container">
                <label for="lastename">
                    Nom
                    <input value="<?php echo $data['lastname']?>" type="text" name="lastname">
                </label>
            </div>
            <div class="input-container">
                <label for="firstname">
                    Prénom
                    <input value="<?php echo $data['firstname']?>" type="text" name="firstname">
                </label>
            </div>
                <label for="image">
                    <?php
                    if(!is_null($data['img_url'])){
                        echo '<img src="' . $data['img_url'] . '" class="profil-img">';
                    }
                    else echo '<img src="./public/assets/icon/profile.svg" class="profil-img">'
                    ?>
                    <input type="file" name="file" style="all: unset">
                    <p>*.png, *.jpg, *.jpeg, max 5Mb</p>
                </label>

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
            <input type="text" name="update" value="1" style="display: none">
            <button type="submit" class="btn-green">Enregistrer</button>
        </form>
    </div>
</div>