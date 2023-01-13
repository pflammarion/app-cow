<?php $roles = $roles ?? [];
$data = $content ??  [];
foreach ($data as $user){
    if ($user['id']==$_GET['id']){
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
                        <label for="prenom">
                            Prénom
                            <input type="text" name="prenom" value="<?php if(isset($box))echo $box["prenom"] ?>">
                        </label>
                        <label for="nom">
                            Prénom
                            <input type="text" name="nom" value="<?php if(isset($box))echo $box["nom"] ?>">
                        </label>
                        <label for="email">
                            Email
                            <input type="email" name="email" value="<?php if(isset($box))echo $box["email"] ?>">
                        </label>
                        <label for="prenom">
                            Nom d'utilisateur
                            <input type="text" name="userName" value="<?php if(isset($box))echo $box["usname"] ?>">
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