<?php

if(isset($_GET['page'])){
    $page = $_GET['page'];
}
$select = 'class="selected-link"';
?>
<div class="sidebar">
    <div class="sidebar-header">
        <div class="opener">
            <img src="./public/assets/icon/double_arrow.svg">
            Ouvrir le volet
        </div>
    </div>
    <div class="sidebar-content">
        <div class="link">
            <a <?php if(isset($page) && $page === 'accueil') echo $select?> href="root">
                <img src="./public/assets/icon/home.svg">
                Accueil
            </a>
            <?php if($_SESSION['role'] === 1){ ?>
                <a <?php if(isset($page) && $page === 'boitier' && $_SESSION['role'] === 1) echo $select?> href="user?page=boitier" >
                    <img src="./public/assets/icon/boitier.svg">
                    Mes boîtiers
                </a>
                <a <?php if(isset($page) && $page === 'vache') echo $select?> href="user?page=vache" >
                    <img src="./public/assets/icon/cow.svg">
                    Mes vaches
                </a>
            <?php }
            else{
                if ($_SESSION['role'] === 3){?>
                    <a <?php if(isset($page) && $page === 'permission') echo $select?> href="admin?page=permission" >
                        <img src="./public/assets/icon/permission.svg">
                        Permission
                    </a>
            <?php }?>
                    <a <?php if(isset($page) && $page === 'faq') echo $select?> href="admin?page=faq" >
                        <img src="./public/assets/icon/faq.svg">
                        FAQ
                    </a>
                    <a <?php if(isset($page) && $page === 'utilisateur') echo $select?> href="admin?page=user" >
                        <img src="./public/assets/icon/user.svg">
                        Utilisateur
                    </a>
                <?php } ?>
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
    $(document).ready(() => {
        $('.closer').on("click", function (){
            $('.sidebar-content').css('height', '0')
            $('.sidebar-content').find('*').each(function(){
                $(this).css('display', 'none')
            });
            $('.opener').css('display', 'flex')
        });
        $('.opener').on("click", function (){
            $('.sidebar-content').css('height', '50px')
            $('.sidebar-content').find('*').each(function(){
                $(this).css('display', 'flex')
            });
            $('.opener').css('display', 'none')
        })
    })

</script>