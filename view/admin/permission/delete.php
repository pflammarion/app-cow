<?php $roles = $roles ??  [];
$role = [];
foreach ($roles as $r){
    if (isset($_GET['id']) && $r['id']=== intval($_GET['id'])){
        $role = $r;
    }
}
?>

<div class="perm-admin-delete">
    <div class="delete-container">
        <h1>Etes-vous sûr de SUPPRIMER le role :</h1>
        <?php if(isset($role))echo '<p>'.$role["name"].'</p>' ?>
        <div class="btn-box-delete">
            <form action="" method="post">

                <input type="hidden" value="delete" name="action" >
                <input type="hidden" value="<?php echo intval($_GET["id"]) ?>" name="id">
                <div class="btn-delete-space">
                    <button type="submit" class="btn-delete">
                        Supprimer
                    </button>
                    <div>
                        <a href="admin?page=permission&action=role" class="btn-return">
                            <img src="./public/assets/icon/retour.svg" alt="retour">
                            Retour
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
