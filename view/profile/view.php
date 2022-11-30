<?php $data = $content ?? []; ?>
<div class="profil">
    <div class="container">
        <h2 id="name"><?php echo $data['firstname'] . " " . $data['lastname'];?></h2>
        <?php
            if(!is_null($data['img_url'])){
                echo '<img src="' . $data['img_url'] . '" class="profil-img" id="img">"';
            }
            else echo '<div class="profil-round"></div>'
        ?>
        <p id="username"><?php echo $data['username'];?></p>
        <div class="profil-mail">
            <img src="./public/assets/icon/mail.svg" alt="email">
            <p id="email"><?php echo $data['email'];?></p>
        </div>
        <button class="btn-edit">Modifier</button>
        <div class="profil-footer">
            <button class="btn-delete">Supprimer</button>
            <p>Rôle : <?php echo $data['role'];?></p>
        </div>
    </div>
</div>