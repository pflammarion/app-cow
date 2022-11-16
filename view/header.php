<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>N o W</title>
    <link rel="stylesheet" href="./public/css/index.css">
    <link href='https://fonts.googleapis.com/css?family=Arima Madurai' rel='stylesheet'>

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
<div class="header">
    <img src="./public/assets/img/LogoCOW.png" alt="Logo Cow">
    <div class="choice">
            <?php
            if (isset($_SESSION['auth']) && $_SESSION['auth']) {
                ?>
                <a href="all?page=logout">
                    <div class="button">
                        Déconnexion
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
                    Incription
                    </div>
                </a>
            <?php
            }
            ?>
    </div>
</div>