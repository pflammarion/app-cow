<?php
$cow = $cow ?? [];
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
        <div class="form-cow-box">
            <div class="create-question">
                <label for="number">
                    Numéro de boitier :
                    <input type="text" name="number" value="<?php if(isset($box))echo $box["number"] ?>">
                </label>
                <label for="name">
                    <div class="cows">
                        <h2>Vache associé :</h2>
                        <?php
                        foreach ($data as $cow ){
                            if ($cow['id'] !== $chip['id']){
                                $box = $cow;
                                print_r($chip);
                                print_r($cow);
                            }

                            $box = $cow;
                            echo '<p>'.$box["name"].'</p>';
                        }
                        ?>

                </label>
                </div>
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
