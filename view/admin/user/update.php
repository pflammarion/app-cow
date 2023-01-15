<?php $roles = $roles ?? [];
$data = $content ??  [];
foreach ($data as $user){
    if ($user['id']===$_GET['id']){
        $box = $user;
    }
}
?>
<div class="user-admin-update">
    <div class="box-user">
        <div class="add-user">
            <h1 class="update-user-admin-modif">Modification de l'utilisateur</h1>
            <form action="" method="post">
                <div class="form-create-box">
                    <div class="user">
                        <label for="firstname">
                            Prénom
                            <input type="text" name="firstname" value="<?php if(isset($box))echo $box["firstname"] ?>">
                        </label>
                        <label for="lastname">
                            Nom
                            <input type="text" name="lastname" value="<?php if(isset($box))echo $box["lastname"] ?>">
                        </label>
                        <label for="email">
                            Email
                            <input type="email" name="email" value="<?php if(isset($box))echo $box["email"] ?>">
                        </label>
                        <label for="username">
                            Nom d'utilisateur
                            <input type="text" name="username" value="<?php if(isset($box))echo $box["username"] ?>">
                        </label>
                    </div>
                </div>

                <div class="btn-box-create">
                    <div>
                        <button type="submit" class="btn-valider">
                            Valider
                        </button>
                    </div>
                    <div>
                        <a href="admin?page=user">
                            <div class="btn-return">
                                <img src="./public/assets/icon/retour.svg" alt="retour">
                                Retour
                            </div>
                        </a>
                    </div>
                </div>
                <input type="hidden" value="update" name="action">
                <input type="hidden" value="<?php echo $_GET["id"] ?>" name="id">
            </form>
        </div>
    </div>
</div>