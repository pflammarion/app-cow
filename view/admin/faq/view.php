<?php $data = $content ??  []; ?>


<div class="view-faq-admin">
    <div class="view-faq-header">
        <input>
        <button type="submit" class="btn-blue">
            <a href="admin?page=faq&action=create" >
                <img class="img-black" src="./public/assets/icon/addquestion.svg">
                <img class="img-white" src="./public/assets/icon/addquestion-white.svg">
            </a>
        </button>
    </div>

    <?php
    foreach ($data as $box){
        echo '<div class="faq-box">';
        echo '<div class="container">';
        echo '<p1>id:'.$box["id"].'</p1>';
        echo '<h2>'.$box["title"].'</h2>';
        echo '<p>'.$box["answer"].'</p>';
        echo '</div>';
        echo '<div class="faq-btn-box">';
        echo '<button type="submit" class="btn-blue">
                <a href="admin?page=faq&action=update&id='.$box["id"].'" ><img src="./public/assets/icon/modifier.svg"></a>
              </button>
              <button type="submit" class="btn-blue">
                <a href="admin?page=faq&action=delete&id='.$box["id"].'" ><img src="./public/assets/icon/delete.svg"></a>
              </button>';
        echo '</div>';
        echo '</div>';
    }
    ?>

</div>

