<?php $data = $content ??  [];
foreach ($data as $cow){
    if ($cow['id']=== (int)$_GET['id']){
        $box = $cow;
    }
}
?>
<div class="cow-vache-delete">
    <div class="cow-view-setting-box-delete">
        <h1>Voulez vous supprimer la vache :</h1>

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
            <div>
                <a href="user?page=vache">
                    <button type="submit" class="btn-delete">
                        Supprimer
                    </button>
                </a>
            </div>
            <div>
                <a href="user?page=vache">
                    <div class="btn-return">
                        <img src="./public/assets/icon/retour.svg" alt="retour">
                        Retour
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
