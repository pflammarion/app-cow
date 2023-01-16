<?php
$roles = $roles ?? [];
$data = $content ??  [];
foreach ($data as $user){
    if ($user['id'] === intval($_GET['id'])){
        $box = $user;
    }
}
?>
<div class="user-admin-update">
            <h1>Modification de l'utilisateur</h1>
            <form action="" method="post">
                    <div class="user">
                        <label for="firstname">
                            Prénom
                            <input type="text" name="firstname" value="<?php if(isset($box))echo $box["firstname"] ?>">
                        </label>
                        <label for="lastname">
                            Nom
                            <input type="text" name="lastname" value="<?php if(isset($box))echo $box["lastname"] ?>">
                        </label>
                        <label for="username">
                            Nom d'utilisateur
                            <input type="text" name="username" value="<?php if(isset($box))echo $box["username"] ?>">
                        </label>
                        <label for="email">
                            Email
                            <input type="email" name="email" value="<?php if(isset($box))echo $box["email"] ?>">
                        </label>
                        <label for="role">
                            Rôle
                            <select name="role">
                                <?php
                                if (isset($box['role'])){
                                    foreach ($roles as $role){
                                        if (intval($role['id']) !== intval($box['role'])){
                                            echo '<option value="' . $role['id'] . '">' . $role['name'] .'</option>';
                                        }
                                        else echo '<option value="' . $role['id'] . '" selected="selected">' . $role['name'] .'</option>';
                                    }
                                }
                            ?>
                            </select>
                        </label>
                    </div>

                <div class="btn-box-update">
                    <div>
                        <a href="admin?page=user">
                            <div class="btn-return">
                                <img src="./public/assets/icon/retour.svg" alt="retour">
                                Retour
                            </div>
                        </a>
                    </div>
                    <div>
                        <button type="submit" class="btn-valider">
                            Valider
                        </button>
                    </div>
                </div>
                <input type="hidden" value="update" name="action">
                <input type="hidden" value="<?php echo $_GET["id"] ?>" name="id">
            </form>
</div>