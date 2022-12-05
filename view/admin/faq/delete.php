<?php $data = $content ??  [];
foreach ($data as $faq){
    if ($faq['id']==$_GET['id']){
        $box = $faq;
    }
}
?>

<div class="delete-container">
    <h1>Etes-vous sûr de  SUPPRIMER la question :</h1>
    <?php echo '<p>'.$box["title"].'</p>' ?>
    <div class="btn-box-delete">
        <form action="" method="post">
            <button type="submit" class="btn-valider" style="background:var(--red)">
                Supprimer
            </button>
            <input type="text" value="delete" name="action" style="display: none">
            <input type="text" value="<?php echo $_GET["id"] ?>" name="id" style="display: none">
        </form>
        <div>
            <a href="admin?page=faq" class="btn-valider">
                <img src="./public/assets/icon/retour.svg">
                Retour
            </a>
        </div>
    </div>
</div>


