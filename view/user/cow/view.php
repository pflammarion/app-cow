<?php $data = $content ??  [] ?>

<div class="cow-view-page-box">

    <div class="cow-view-setting-box">
        <div class="cow-view-btn-box">
            <a></a><a></a>
        </div>
        <a href="user?page=vache&action=create">
            <div class="cow-view-add-box">
                <div class="cow-view-btn-box">
                </div>
                <h1 class="font-arima" style="font-weight: bold">Ajouter une vache</h1>
                <div class="cow-view-profil">
                    <img src="./public/assets/icon/cow.svg" alt="cow">
                </div>
            </div>
        </a>
    </div>

    <?php
    foreach ($data as $box){
        echo '<div class="cow-view-setting-box">';
        echo '<div class="cow-view-btn-box">';
        echo '<a class="btn-blue" href="user?page=vache&action=delete&cowId='.$box['id'].'&name='.$box['name'].'">
                <img class="img-black" src="./public/assets/icon/delete.svg" alt="delete">
                <img class="img-white" src="./public/assets/icon/delete-white.svg" alt="delete">
            </a>
            <a class="btn-blue" href="user?page=vache&action=update&cowId='.$box['id'].'&name='.$box['name'].'">
                <img class="img-black" src="./public/assets/icon/modifier.svg" alt="edit">
                <img class="img-white" src="./public/assets/icon/modifier-white.svg" alt="edit">
            </a>';
        echo '</div>';
        if (isset($box['chip_num'])){
            echo '<div class="cow-view-box">';
            echo '<div class="status connected">' .$box['chip_num'] . '</div>';
        }
        else {
            echo '<a href="user?page=link&cow=' . $box['id'] .'">';
            echo '<div class="cow-view-box">';
            echo  '<div class="status not-connected"></div>';
        }
        echo '<div class="cow-view-profil">';
        if(!is_null($box['img_cow'])){
            echo '<div class="crop-img"><img src="' . $box['img_cow'] . '" class="cow-img" alt="Cow"></div>';
        }
        else echo '<div class="crop-img default"><img class="cow-img" src="./public/assets/icon/cow.svg" alt="Cow"></div>';
        echo '</div>';
        echo '<h1>'.$box["name"].'<br>'
             .$box["number"].'</h1>';
        echo '</div>';
        if (!isset($box['chip_num'])){
            echo '</a>';
        }
        echo '</div>';
    }
    ?>

</div>
