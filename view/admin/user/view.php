<?php $data = $content ??  []; ?>


<div class="view-user-admin">
    <div class="view-user-header">
        <input>
        <a class="btn-blue" href="admin?page=user&action=create" >
            <img class="img-black" src="./public/assets/icon/add_user_black.svg" alt="add user">
            <img class="img-white" src="./public/assets/icon/add_user_white.svg" alt="add user">
        </a>
    </div>

    <?php
    foreach ($data as $box){
        echo '<div class="user-box">';
        echo '<div class="container">';
        echo '<span class="p1">id:'.$box["id"].'</span>';
        echo '<span>'.$box["firstname"].'</span>';
        echo '<span>'.$box["lastname"].'</span>';
        echo '<span>'.$box["email"].'</span>';
        echo '<span>'.$box["username"].'</span>';
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
        echo '</div>';
    }
    ?>

</div>

