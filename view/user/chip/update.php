<?php $data = $content ??  [];
foreach ($data as $chip){
    if ($chip['id'] === intval($_GET['chipId'])){
        $box = $chip;
    }
}
?>
<div class="cow-vache-add">
    <h1>Modifier le Boitier : <?php echo $box["number"] ?></h1>
    <form action="" method="post">
        <div class="form-cow-box">
            <div class="create-question">
                <label for="number">
                    Numéro de boitier :
                    <input type="text" name="number" value="<?php if(isset($box))echo $box["number"] ?>">
                </label>
                <label for="name">
                    Nom de la Vache associée <br>(si existante) :
                    <input type="text" name="name" value="<?php if(isset($box))echo $box["name"] ?>">
                </label>
            </div>
        </div>
        <div class="box-around-btn">
            <div class="btn-cow">
                <div>
                    <button type="submit" class="btn-valider">
                        Valider
                    </button>
                </div>
                <div>
                    <a href="user?page=boitier">
                        <div class="btn-return">
                            <img src="./public/assets/icon/retour.svg" alt="retour">
                            Retour
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <input type="hidden" value="create" name="action">
    </form>
</div>
