<?php $data = $content ??  [];
foreach ($data as $cow){
    if ($cow['id'] === intval($_GET['cowId'])){
        $box = $cow;
    }
}
?>
<div class="cow-vache-delete">
    <div class="cow-view-setting-box-delete">
        <h1>Voulez vous supprimer la vache : <?php echo $box["name"] ?></h1>

        <div class="cow-view-setting-box">
            <div class="cow-view-box">
                <div class="cow-view-profil">
                    <img src="./public/assets/icon/profile.svg" class="profil-img">
                </div>
                <?php
                echo '<h1>'.$box["name"].'<br>
                    '.$box["number"].'</h1>';
                ?>
            </div>
        </div>

        <div class="btn-cow">
            <form action="" method="post">
                <input type="hidden" value="delete" name="action" >
                <input type="hidden" value="<?php echo htmlspecialchars($_GET['name']) ?>" name="name">
                <input type="hidden" value="<?php echo intval($_GET["cowId"]) ?>" name="cowId">
                <div class="btn-cow">
                    <button type="submit" class="btn-delete">
                        Supprimer
                    </button>
                    <div>
                        <a href="user?page=vache" class="btn-return">
                            <img src="./public/assets/icon/retour.svg" alt="retour">
                            Retour
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
