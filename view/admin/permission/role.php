<?php $data = $data ?? []?>

<div class="role">
    <h1>Rôles :</h1>
    <div class="container">
        <?php
        foreach ($data as $role){
            echo '<div class="role-container">';
            echo '<p>' . $role['name'] . '</p>';
            echo '<div>';
            if ($role['id'] !== 3){
                echo '<a class="btn-blue" href="admin?page=permission&action=update&id='.$role["id"].'" >
                <img class="img-black" src="./public/assets/icon/modifier.svg" alt="edit">
                <img class="img-white" src="./public/assets/icon/modifier-white.svg" alt="edit">
              </a>
              <a class="btn-blue" href="admin?page=permission&action=delete&id='.$role["id"].'" >
                <img class="img-black" src="./public/assets/icon/delete.svg" alt="delete">
                <img class="img-white" src="./public/assets/icon/delete-white.svg" alt="delete">
              </a>';
            }
            echo '</div>';
            echo '</div>';
        }
        ?>

    </div>
    <div class="btn-container">
        <a href="/admin?page=permission">
            <div class="btn-return">
                <img src="./public/assets/icon/retour.svg" alt="retour">
                Retour
            </div>
        </a>
        <a href="/admin?page=permission&action=create">
            <div class="btn-green">
                Ajouter
            </div>
</a>
    </div>
</div>



