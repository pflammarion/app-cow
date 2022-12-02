<?php $data = $content ??  []; ?>
<?php print_r($data); ?>

<div class="view">
    <fieldset>
        <legend>Rechercher un article</legend>
    </fieldset>
    <div class="btn-container">
        <button type="submit" class="btn-blue">
            <a href="admin?page=faq&action=create" >
                <img class="img-black" src="./public/assets/icon/addquestion.svg">
                <img class="img-white" src="./public/assets/icon/addquestion-white.svg">
            </a>
        </button>
        <button type="submit" class="btn-blue">
            <a href="admin?page=faq&action=update" ><img src="./public/assets/icon/modifier.svg"></a>
        </button>

        <button type="submit" class="btn-blue">
            <a href="admin?page=faq&action=delete" ><img src="./public/assets/icon/delete.svg"></a>
        </button>
    </div>
</div>

