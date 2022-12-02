<?php $data = $content ?? []; ?>
<div class="profil">
    <div class="container">
        <h2><?php echo $data['firstname'] . " " . $data['lastname'];?></h2>
        <?php
            if(!is_null($data['img_url'])){
                echo '<img src="' . $data['img_url'] . '" class="profil-img">';
            }
            else echo '<img src="./view/profile/images/test.png" class="profil-img">'
        ?>
        <p class="font-arima"><?php echo $data['username'];?></p>
        <div class="profil-mail">
            <img src="./public/assets/icon/mail.svg" alt="email">
            <p><?php echo $data['email'];?></p>
        </div>
        <button class="btn-edit">Modifier</button>
        <div class="profil-footer">
            <button class="btn-delete">Supprimer</button>
            <p>Rôle : <?php echo $data['role'];?></p>
        </div>
    </div>
</div>