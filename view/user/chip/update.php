<?php
$data = $content ??  [];
foreach ($data as $cow){
    if ($cow['id']==$_GET['id']){
        $box = $cow;
    }
}
?>
<div class="cow-vache-add">
    <h1>Modifier la Puce de : NomDeLaVache</h1>
    <form action="" method="post">
        <div class="form-cow-box">
            <div class="create-question">
                <label for="name">
                    Nom de la Vache :
                    <input type="text" name="name" >
                </label>
                <label for="number">
                    Numéro de boitier :
                    <input type="text" name="number" >
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
