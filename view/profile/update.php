<?php $data = $content ?? []; ?>
<div class="profil-update">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data" id="form">
            <div>
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
                    if((!is_null($data['img_url']) && file_exists($data['img_url']))){
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
            </div>
            <div>
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
                <div class="card-footer">
                    <a class="btn-edit" href="profil?action=view">Retour</a>
                    <button id="button" type="submit" class="btn-green">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
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