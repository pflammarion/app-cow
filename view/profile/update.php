<?php $data = $content ?? []; ?>
<div class="profil-update">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input-container">
                <label for="lastename">
                    Nom
                    <input value="<?php echo $data['lastname']?>" type="text" name="lastname">
                </label>
            </div>
            <div class="input-container">
                <label for="firstname">
                    Prénom
                    <input value="<?php echo $data['firstname']?>" type="text" name="firstname">
                </label>
            </div>
                <label for="image">
                    <?php
                    if(!is_null($data['img_url'])){
                        echo '<div class="crop-img"><img src="' . $data['img_url'] . '" id="profil-img"></div>';
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
                if(!is_null($data['img_url'])){
                    echo '<label for="delete-img">Supprimer ma photo<input type="checkbox" name="delete-img"></label>';
                }?>

            <div class="input-container">
                <label for="username">
                    Nom d'utilisateur
                    <input value="<?php echo $data['username']?>" type="text" name="username">
                </label>
            </div>
            <div class="input-container">
                <label for="email">
                    Adresse email
                    <input value="<?php echo $data['email']?>" type="email" name="email">
                </label>
            </div>
            <input type="text" name="update" value="1" style="display: none">
            <button type="submit" class="btn-green">Enregistrer</button>
        </form>
    </div>
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
        $('#hidden-file-input').on('click', function(e) {
            e.preventDefault();
            $('#upload').trigger('click');
        });
    });
</script>