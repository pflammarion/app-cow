<?php
$data = $content ??  [];
foreach ($data as $cow){
    if ($cow['id'] === intval($_GET['cowId'])){
        $box = $cow;
    }
}
?>
<div class="cow-vache-add">
    <h1>Modifier la Vache : <?php echo $box["name"] ?></h1>
    <form action="" method="post" enctype="multipart/form-data" id="form">
        <input type="hidden" value="<?php echo intval($_GET["cowId"]) ?>" name="cowId">
        <div class="form-cow-box">
            <div class="create-question">
                <label for="name">
                    Nom de la Vache :
                    <input type="text" name="name" value="<?php if(isset($box))echo $box["name"] ?>">
                </label>
                <label for="number">
                    Numéro de la vache :
                    <input type="text" name="number" value="<?php if(isset($box))echo $box["number"] ?>">
                </label>

                <label for="image">
                    <?php
                    if((!is_null($box['img_cow']) && file_exists($box['img_cow']))){
                        echo '<div class="crop-img"><img src="' . $box['img_cow'] . '" id="profil-img"></div>';
                    }
                    else echo '<div class="crop-img"><img src="./public/assets/icon/profile.svg" id="profil-img"></div>'
                    ?>

                    <input id="upload" type="file" name="file">
                    <div class="file">
                        <img id="hidden-file-input" src="./public/assets/icon/upload.svg" alt="upload">
                        <p>*.png, *.jpg, *.jpeg, max 5Mb</p>
                    </div>
                </label>
                <?php
                if(!is_null($box['img_cow'])){
                    echo '<label for="delete-img">Supprimer ma photo<input type="checkbox" name="delete-img"></label>';
                }?>

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
                    <a href="user?page=vache">
                        <div class="btn-return">
                            <img src="./public/assets/icon/retour.svg" alt="retour">
                            Retour
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <input type="hidden" value="update" name="action">
    </form>
</div>

<script>
    $(document).ready(() => {
        $('#upload').change(function () {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $("#profil-img").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $('input[name="delete-img"]').change(function () {
            if($('input[name="delete-img"]').prop("checked")){
                $("#profil-img").css('opacity', '0.3')
            }
            else $("#profil-img").css('opacity', '1')
        });
        $('#hidden-file-input').on('click', function(e) {
            e.preventDefault();
            $('#upload').trigger('click');
        });

        $('#button').on('click', function (e){
            e.preventDefault();
            $("#overlay").fadeIn(300);
            $('#form').submit();
        })

    });
</script>
