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
        if ($box['ban'] !== 0){
            echo '<div class="user-box ban">';
        }else{
            echo '<div class="user-box">';
        }
        echo '<span class="p1">id:'.$box["id"].'</span>';
        echo '<span class="p2">' . $box['role_name'] . '</span>';
        echo '<div class="user">';
        echo '<span>'.$box["firstname"].'</span>';
        echo '<span>'.$box["lastname"].'</span>';
        echo '</div>';
        echo '<div class="email">';
        echo '<img src="./public/assets/icon/mail.svg" alt="email" />';
        echo '<a href="mailto:' . $box['email'] . '">'.$box["email"].'</a>';
        echo '</div>';
        echo '<div class="username">';
        echo '<img src="./public/assets/icon/user.svg" alt="user" />';
        echo '<span>'.$box["username"].'</span>';
        echo '</div>';

        if ($box['ban'] === 0){
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
        }
        echo '</div>';
    }
    ?>

</div>

