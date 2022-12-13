<?php $data = $content ??  []; ?>


<div class="view-faq-admin">
    <div class="view-faq-header">
        <input>
            <a class="btn-blue" href="admin?page=faq&action=create" >
                <img class="img-black" src="./public/assets/icon/addquestion.svg">
                <img class="img-white" src="./public/assets/icon/addquestion-white.svg">
            </a>
    </div>

    <?php
    foreach ($data as $box){
        echo '<div class="faq-box">';
        echo '<div class="container">';
        echo '<p class="p1">id:'.$box["id"].'</p>';
        echo '<h2>'.$box["title"].'</h2>';
        echo '<p>'.$box["answer"].'</p>';
        echo '</div>';
        echo '<div class="faq-btn-box">';
        echo '<a class="btn-blue" href="admin?page=faq&action=update&id='.$box["id"].'" >
                <img class="img-black" src="./public/assets/icon/modifier.svg">
                <img class="img-white" src="./public/assets/icon/modifier-white.svg">
              </a>
              <a class="btn-blue" href="admin?page=faq&action=delete&id='.$box["id"].'" >
                <img class="img-black" src="./public/assets/icon/delete.svg">
                <img class="img-white" src="./public/assets/icon/delete-white.svg">
              </a>';
        echo '</div>';
        echo '</div>';
    }
    ?>

</div>

