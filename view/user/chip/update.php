<?php
$data = $content ??  [];
foreach ($data as $chip){
    if ($chip['id'] === intval($_GET['chipId'])){
        $box = $chip;
    }
}
?>
<div class="cow-vache-add">
    <h1>Modifier le Boitier : <?php echo $box["number"] ?></h1>
    <form action="" method="post">
        <input type="hidden" value="<?php echo intval($_GET["chipId"]) ?>" name="chipId">
        <div class="form-cow-box">
            <div class="create-question">
                <label for="number">
                    Numéro de boitier :
                    <input type="text" name="number" value="<?php if(isset($box))echo $box["number"] ?>">
                </label>

                </div>
            </div>
        </div>

        <div class="box-around-btn">
            <div class="btn-cow">
                    <button type="submit" class="btn-valider">
                        Valider
                    </button>
                    <a href="user?page=boitier" class="btn-return">
                            <img src="./public/assets/icon/retour.svg" alt="retour">
                            Retour
                    </a>
            </div>
        </div>

        <input type="hidden" value="update" name="action">
    </form>
</div>
