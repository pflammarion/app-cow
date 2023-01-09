<?php $data = $content ??  []; ?>

<div class="faq-user">
    <h1>FAQ</h1>
    <?php
    echo '<div class="faq-user-article">';
    foreach ($data as $box){
        echo '<h2 class="view-faq-admin-h2">'.$box["title"].'</h2>';
        echo '<p class ="">'.$box["answer"].'</p>';
        echo '<span class="faq-user-separator"></span>';

    }
    echo '</div>';
    ?>
</div>
