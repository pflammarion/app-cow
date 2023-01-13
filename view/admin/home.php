<?php $perms = $perms?? [] ?>
<div class="admin-home">
    <h1>Choix de pages</h1>
    <div class = "home-box">
        <?php if ($perms['permission']){?>
        <a href="admin?page=permission" class = "card">
            <img src="./public/assets/icon/permission.svg" alt="permission">
            <p> Permission </p>
        </a>
        <?php }?>
        <?php if ($perms['faq']){?>
        <a href="admin?page=faq" class="card">
            <img src="./public/assets/icon/faq.svg" alt="faq">
            <p>FAQ</p>
        </a>
        <?php }?>
        <?php if ($perms['user']){?>
        <a href="admin?page=user" class="card">
            <img src="./public/assets/icon/user.svg" alt="user">
            <p>Utilisateurs</p>
        </a>
        <?php }?>
    </div>
</div>
