<?php $data = $content ??  []; ?>

<div class="cow-view-page-box">

    <div class="cow-view-setting-box">
        <div class="cow-view-btn-box">
            <a></a><a></a>
        </div>
        <a href="user?page=boitier&action=create">
            <div class="cow-view-add-box">
                <div class="cow-view-btn-box">
                </div>
                <h1 class="font-arima" style="font-weight: bold">Ajouter un boitier</h1>
                <div class="cow-view-profil">
                    <img src="./public/assets/icon/boitier.svg">
                </div>
            </div>
        </a>
    </div>

    <?php
    foreach ($data as $box){
        echo '<div class="cow-view-setting-box">';
        echo '<div class="cow-view-btn-box">';
        echo '<a class="btn-blue" href="user?page=boitier&action=delete&chipId='.$box['id'].'&number='.$box['number'].'">
                <img class="img-black" src="./public/assets/icon/delete.svg" alt="delete">
                <img class="img-white" src="./public/assets/icon/delete-white.svg" alt="delete">
            </a>
            <a class="btn-blue" href="user?page=boitier&action=update&chipId='.$box['id'].'&number='.$box['number'].'">
                <img class="img-black" src="./public/assets/icon/modifier.svg" alt="edit">
                <img class="img-white" src="./public/assets/icon/modifier-white.svg" alt="edit">
            </a>';
        echo '</div>';
        if (isset($box['cow'])){
            echo '<div class="cow-view-box">';
            echo '<div class="status connected">' .$box['cow'] . '</div>';
        }
        else {
            echo '<a href="user?page=link&chip=' . $box['id'] .'">';
            echo '<div class="cow-view-box">';
            echo  '<div class="status not-connected"></div>';
        }
        echo '<div class="cow-view-profil">';
        echo '<img src="./public/assets/icon/boitier.svg" class="chip-img" alt="chip image">';
        echo '</div>';
        echo '<h1>'.$box["number"].'</h1>';
        echo '</div>';
        if (!isset($box['chip_num'])){
            echo '</a>';
        }
        echo '</div>';
    }
    ?>

</div>

