<?php $data = $content ??  [];
foreach ($data as $faq){
    if ($faq['id']=== (int)$_GET['id']){
        $box = $faq;
    }
}
?>

<div class="faq-admin-delete">
    <div class="delete-container">
        <h1>Etes-vous sûr de SUPPRIMER la question :</h1>
        <?php if(isset($box))echo '<p>'.$box["title"].'</p>' ?>
        <div class="btn-box-delete">
            <form action="" method="post">

                <input type="hidden" value="delete" name="action" >
                <input type="hidden" value="<?php echo $_GET["id"] ?>" name="id">
                <div class="btn-delete-space">
                    <button type="submit" class="btn-valider" style="background:var(--red)">
                        Supprimer
                    </button>
                    <div>
                        <a href="admin?page=faq" class="btn-valider">
                            <img src="./public/assets/icon/retour.svg" alt="retour">
                            Retour
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>



