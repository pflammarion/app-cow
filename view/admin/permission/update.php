<?php
$roles = $roles ?? [];
$role = [];
if (isset($_GET['id'])){
    $id = intval($_GET['id']);
    foreach ($roles as $r){
        if ($r['id']=== $id){
            $role = $r;
        }
    }
}
?>
<div class="perm-create">
    <h1>Modifier le rôle :</h1>
    <form action="" method="post">
        <label for="role">
            <input type="text" name="role" value="<?php if(isset($role['name'])) echo $role['name'] ?>">
        </label>
        <div class="btn-container">
            <div>
                <a href="/admin?page=permission&action=role">
                    <div class="btn-return">
                        <img src="./public/assets/icon/retour.svg" alt="retour">
                        Retour
                    </div>
                </a>
            </div>
            <div class="btn-box-create">
                <div>
                    <button type="submit" class="btn-valider">
                        Valider
                    </button>
                </div>

            </div>
        </div>

        <input type="hidden" value="update" name="action">
        <input type="hidden" value="<?php if(isset($role['id'])) echo $role['id'] ?>" name="id">

    </form>
</div>

