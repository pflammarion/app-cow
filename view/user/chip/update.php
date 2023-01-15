<?php
$cow = $cow ?? [];
$herd = $herd ?? [];
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

                        <div class="cows">
                            <h2>Mes Vaches</h2>
                            <div class="cow-scroller">
                                <?php
                                foreach ($herd as $cow){
                                    if ($cow['id'] != $_GET['cow']){
                                        if (isset($cow['level'])) echo '<a href="user?page=accueil&cow=' . $cow['id'] . '"><div class="herd alert alert' . $cow['level'] .'"><div class="herd-name"><img src="./public/assets/icon/cow.svg" alt="cow">' . $cow['name'] . '</div><img src="./public/assets/icon/alert' . $cow['level'] . '.svg" alt="alert"></div></a>';
                                        else echo '<a href="user?page=accueil&cow=' . $cow['id'] . '"><div class="herd alert"><div class="herd-name"><img src="./public/assets/icon/cow.svg" alt="cow">' . $cow['name'] . '</div></div></a>';
                                    }
                                }
                                if(sizeof($herd) === 0){
                                    echo '<p>Vous n\'avez pas de vache enregistrée</p>';
                                }
                                ?>
                            </div>
                        </div>


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
