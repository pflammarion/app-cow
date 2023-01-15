<?php

if(isset($_GET['page'])){
    $page = $_GET['page'];
    switch ($page){
        case 'accueil':
            $paginer = 'Accueil';
            break;
        case 'boitier':
            $paginer = 'Mes boîtiers';
            break;
        case 'vache':
            $paginer = 'Mes vaches';
            break;
        case 'view':
            $paginer = 'Mon profil';
            break;
        case 'user':
            $paginer = 'Utilisateur';
            break;
        case 'permission':
            $paginer = 'Permission';
            break;
        case 'faq':
            $paginer = 'FAQ';
            break;
    }
}
$select = 'class="selected-link"';

?>
<div class="sidebar">
    <div class="background"></div>
    <div class="sidebar-header">
        <div class="paginer">
            <img src="./public/assets/icon/sidebar_icon.svg">
            <?php if (isset($paginer)) echo $paginer?>
        </div>
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
                <a <?php if(isset($page) && $page === 'boitier') echo $select?> href="user?page=boitier" >
                    <img src="./public/assets/icon/boitier.svg">
                    Mes boîtiers
                </a>
                <a <?php if(isset($page) && $page === 'vache') echo $select?> href="user?page=vache" >
                    <img src="./public/assets/icon/cow.svg">
                    Mes vaches
                </a>
            <?php }
            else{
                if (pageAuthorization('admin/permission')){?>
                    <a <?php if(isset($page) && $page === 'permission') echo $select?> href="admin?page=permission" >
                        <img src="./public/assets/icon/permission.svg">
                        Permission
                    </a>
            <?php }?>
                <?php if (pageAuthorization('admin/faq')){?>
                    <a <?php if(isset($page) && $page === 'faq') echo $select?> href="admin?page=faq" >
                        <img src="./public/assets/icon/faq.svg">
                        FAQ
                    </a>
            <?php }?>
                <?php if (pageAuthorization('admin/ticket')){?>
                    <a <?php if(isset($page) && $page === 'ticket') echo $select?> href="admin?page=ticket" >
                        <img src="./public/assets/icon/ticket.svg">
                        SAV
                    </a>
                <?php }?>
                <?php if (pageAuthorization('admin/user')){?>
                    <a <?php if(isset($page) && $page === 'utilisateur') echo $select?> href="admin?page=user" >
                        <img src="./public/assets/icon/user.svg">
                        Utilisateur
                    </a>
            <?php }?>
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

        function checkWidth() {
            let windowsize = $(window).width();
            if ( windowsize > 800){
                $('.closer').on("click", function (){
                    $('.sidebar-content').addClass('responsive')
                    $('.sidebar-content').find('*').each(function(){
                        $(this).css('display', 'none')
                    });
                    $('.opener').css('display', 'flex')
                });
                $('.opener').on("click", function (){
                    $('.sidebar-content').removeClass('responsive')
                    $('.sidebar-content').find('*').each(function(){
                        $(this).css('display', 'flex')
                    });
                    $('.opener').css('display', 'none')
                })
            }
            else {
                $('.closer').on("click", function (){
                    $('.sidebar-content').removeClass('responsive')
                    $('.background').css('display', 'none')
                    $('html').css('overflow-y', 'auto')
                });
                $('.background').on("click", function (){
                    $('.sidebar-content').removeClass('responsive')
                    $('.background').css('display', 'none')
                    $('html').css('overflow-y', 'auto')
                });

                $('.paginer').find('img').on("click", function (){
                    $('.sidebar-content').addClass('responsive')
                    $('.background').css('display', 'block')
                    $('html').css('overflow-y', 'hidden')
                });
            }

        }
        // Execute on load
        checkWidth();
        // Bind event listener
        $(window).resize(checkWidth);

    })

</script>