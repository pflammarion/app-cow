<?php $data = $content ??  []; ?>


<div class="view-user-admin">
    <div class="view-user-header">
        <input>
        <a class="btn-blue" href="admin?page=user&action=create" >
            <img class="img-black" src="./public/assets/icon/addquestion.svg" alt="add question">
            <img class="img-white" src="./public/assets/icon/addquestion-white.svg" alt="add question">
        </a>
    </div>

    <?php
    foreach ($data as $box){
        echo '<div class="user-box">';
        echo '<div class="container">';
        echo '<p class="p1">id:'.$box["id"].'</p>';
        echo '<h2 class="view-user-admin-h2">'.$box["User_FirstName"].'</h2>';
        echo '<p>'.$box["User_LastName"].'</p>';
        echo '</div>';
        echo '<div class="user-btn-box">';
        echo '<a class="btn-blue" href="admin?page=user&action=update&id='.$box["id"].'" >
                <img class="img-black" src="./public/assets/icon/modifier.svg" alt="edit">
                <img class="img-white" src="./public/assets/icon/modifier-white.svg" alt="edit">
              </a>
              <a class="btn-blue" href="admin?page=user&action=delete&id='.$box["id"].'" >
                <img class="img-black" src="./public/assets/icon/delete.svg" alt="delete">
                <img class="img-white" src="./public/assets/icon/delete-white.svg" alt="delete">
              </a>';
        echo '</div>';
        echo '</div>';
    }
    ?>

</div>

