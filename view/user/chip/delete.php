<?php $data = $content ??  [];
foreach ($data as $chip){
    if ($chip['id'] === intval($_GET['chipId'])){
        $box = $chip;
    }
}
?>

<div class="cow-vache-delete">
    <div class="cow-view-setting-box-delete">
        <h1>Voulez vous supprimer le boitier : <?php echo $box["number"] ?></h1>

        <div class="cow-view-setting-box">
            <div class="cow-view-box">
                <div class="cow-view-profil">
                    <img src="./public/assets/icon/profile.svg" class="profil-img">
                </div>
                <?php
                echo '<h1>'.$box["number"].'</h1>';
                ?>
            </div>
        </div>

        <div class="btn-cow">
            <form action="" method="post">
                <input type="hidden" value="delete" name="action" >
                <input type="hidden" value="<?php echo htmlspecialchars($_GET['number']) ?>" name="number">
                <input type="hidden" value="<?php echo intval($_GET["chipId"]) ?>" name="chipId">
                <div class="btn-cow">

                    <a href="user?page=boitier" class="btn-return">
                        <img src="./public/assets/icon/retour.svg" alt="retour">
                        Retour
                    </a>
                    <button type="submit" class="btn-delete">
                        Supprimer
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
