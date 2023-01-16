<?php $data = $content ??  [];
foreach ($data as $user){
    if ($user['id']=== intval($_GET['id'])){
        $box = $user;
    }
}
?>

<div class="user-admin-delete">
    <div class="delete-container">
        <h1>Etes-vous sûr de SUPPRIMER l'utilisateur :</h1>
        <?php if(isset($box))echo '<p>'.$box["firstname"]." ".$box["lastname"].'</p>' ?>
        <div class="btn-box-delete">
            <form action="" method="post">
                <input type="hidden" value="delete" name="action" >
                <input type="hidden" value="<?php echo $_GET["id"] ?>" name="id">
                <div class="btn-delete-space">
                    <button id="env" type="submit" class="btn-delete">
                        Supprimer
                    </button>
                        <a href="admin?page=user" class="btn-valider">
                            <img src="./public/assets/icon/retour.svg" alt="retour">
                            Retour
                        </a>
                </div>
            </form>

        </div>
    </div>
</div>

<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>

<script>
    $(document).ready(() => {

        $('#env').on('click', function (e){
            e.preventDefault();
            $("#overlay").fadeIn(300);
            $('form').submit();
        })
    });
</script>



