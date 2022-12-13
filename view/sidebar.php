<?php

if(isset($_GET['page'])){
    $page = $_GET['page'];
}
$select = 'class="selected-link"';
?>
<div class="sidebar">
    <div class="sidebar-header">

    </div>
    <div class="sidebar-content">
        <div class="link">
            <a <?php if(isset($page) && $page === 'accueil') echo $select?> href="root">
                <img src="./public/assets/icon/home.svg">
                Accueil
            </a>
            <a <?php if(isset($page) && $page === 'boitier') echo $select?> href="user?page=boitier" >
                <img src="./public/assets/icon/boitier.svg">
                Mes boîtiers
            </a>
            <a <?php if(isset($page) && $page === 'vache') echo $select?> href="user?page=vache" >
                <img src="./public/assets/icon/cow.svg">
                Mes vaches
            </a>
            <a <?php if(isset($page) && $page === 'view') echo $select?> href="profil?page=view">
                <img src="./public/assets/icon/profile.svg">
                Mon profil
            </a>
        </div>
        <div class="closer">
            <img src="./public/assets/icon/double_arrow.svg">
            Fermer le volet
        </div>
    </div>
</div>

<script>

</script>