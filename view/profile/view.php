<?php $data = $content ?? []; ?>
<div class="profil">
    <div class="container">
        <h2><?php echo $data['firstname'] . " " . $data['lastname'];?></h2>
        <?php
            if(!is_null($data['img_url'])){
                echo '<div class="crop-img"><img src="' . $data['img_url'] . '" class="profil-img"></div>';
            }
            else echo '<a href="profil?action=update" class="img-link"><div class="crop-img"><img src="./public/assets/icon/profile.svg" class="profil-img"></div></a>'
        ?>
        <p class="font-arima"><?php echo $data['username'];?></p>
        <div class="profil-mail">
            <img src="./public/assets/icon/mail.svg" alt="email">
            <p><?php echo $data['email'];?></p>
        </div>
        <a href="profil?action=update" class="btn-edit-margin">
            <div class="btn-edit">
                Modifier
            </div>
        </a>
        <div class="profil-footer">
            <a href="profil?action=delete"><div class="btn-delete">Supprimer</div></a>
            <p>Rôle : <?php echo $data['role'];?></p>
        </div>
    </div>
</div>