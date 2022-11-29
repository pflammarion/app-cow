<?php $data = $content ?? []; ?>
<div class="profil">
    <div class="container">
        <h2 id="name"><?php echo $data['firstname'] . " " . $data['lastname'];?></h2>
        <img src="<?php echo $data['img_url'];?>" class="profil-img" id="img">
        <p id="username"><?php echo $data['username'];?></p>
        <div class="profil-mail">
            <img src="./public/assets/icon/sendMail.svg" alt="email">
            <p id="email"><?php echo $data['email'];?></p>
        </div>
        <button>Modifier</button>
        <div class="profil-footer">
            <button class="">Supprimer</button>
            <p>Rôle : <?php echo $data['role'];?></p>
        </div>
    </div>
</div>