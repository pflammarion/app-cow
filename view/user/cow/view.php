<?php $data = $content ??  [];

usort($data, function ($item1, $item2) {
    return $item1['name'] <=> $item2['name'];
});
?>

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
                    <img src="./public/assets/icon/cow.svg">
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
            <a class="btn-blue" href="user?page=vache&action=update">
                <img class="img-black" src="./public/assets/icon/modifier.svg" alt="edit">
                <img class="img-white" src="./public/assets/icon/modifier-white.svg" alt="edit">
            </a>';
        echo '</div>';
        echo '<div class="cow-view-box">';
        echo '<div class="cow-view-profil">';
        echo '<img src="./public/assets/icon/profile.svg" class="profil-img">';
        echo '</div>';
        echo '<h1>'.$box["name"].'<br>
            '.$box["number"].'</h1>';
        echo '</div>';
        echo '</div>';
    }
    ?>

</div>
