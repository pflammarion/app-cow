<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>N o W</title>
    <link rel="icon" type="image/x-icon" href="./public/assets/img/favicon.ico">
    <link rel="stylesheet" href="./public/css/index.css">
    <link rel="stylesheet" href="./public/css/jquery-ui.min.css">
    <link href='https://fonts.googleapis.com/css?family=Arima Madurai' rel='stylesheet'>
    <script src="./public/js/jquery-3.6.1.min.js"></script>
    <script src="./public/js/jquery-ui.min.js"></script>
    <script src="./public/js/index.js"></script>

    <?php
    if (isset($_SESSION['auth']) && $_SESSION['auth']){
        if($_SESSION['role'] === 1 ){
            echo '<link rel="stylesheet" href="./public/css/user/index.css">';
        }
        else{
            echo '<link rel="stylesheet" href="./public/css/admin/index.css">';
        }
    }
    ?>

</head>
<body>
<!--fix bug load https://bugzilla.mozilla.org/show_bug.cgi?id=1404468 -->
<script>0</script>
<!--end-->
<script>
    for (let i = 0; i < 198; i++){
        $(document.body).append('<div class="snow"></div>')
    }
</script>

<div class="header">
    <a href="root" class="logo-link">
        <img class="img-header" src="./public/assets/img/LogoCOW2023.svg" alt="Logo Cow">
        <?php
        if(date('i') % 2 == 0){
            $file = "LogoCOWSanta.svg";
        }
        else $file = "LogoCOWSanta2.svg";
        echo '<img class="img-header-santa" src="./public/assets/img/' . $file .'" alt="Logo Cow Santa">';
        ?>
    </a>


    <div class="choice">
            <?php
            if (isset($_SESSION['auth']) && $_SESSION['auth']) {
                ?>
                <a href="all?page=logout">
                    <div class="button">
                        <span>Déconnexion</span>
                        <img src="./public/assets/icon/LogoEXIT.svg" alt="Logo Exit">
                    </div>
                </a>
            <?php
            }
            else{
                ?>
                <a href="login?page=login">
                    Connexion
                </a>
                <a href="login?page=register">
                    <div class="button">
                    Inscription
                    </div>
                </a>
            <?php
            }
            ?>
    </div>
</div>
<div class="super-section">
    <?php if (isset($_SESSION['auth']) && $_SESSION['auth']) include("./view/sidebar.php")?>
