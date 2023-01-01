<div class="level-selector">
    <div class="container">
        <h1>Choisir un capteur</h1>
        <div class="button-container">
            <?php echo '<a href="user?page=accueil&action=level&chipid='.$_GET['chipid'].'&cow=' . $_GET['cow'] . '&sensorid=1">'; ?>
                <img src="./public/assets/icon/heart.svg">
                Cardiaque
            </a>
            <?php echo '<a href="user?page=accueil&action=level&chipid='.$_GET['chipid'].'&cow=' . $_GET['cow'] . '&sensorid=2">'; ?>
                <img src="./public/assets/icon/air.svg">
                Monoxyde
            </a>
            <?php echo '<a href="user?page=accueil&action=level&chipid='.$_GET['chipid'].'&cow=' . $_GET['cow'] . '&sensorid=3">'; ?>
                <img src="./public/assets/icon/sound.svg">
                Sonore
            </a>
            <?php echo '<a href="user?page=accueil&action=level&chipid='.$_GET['chipid'].'&cow=' . $_GET['cow'] . '&sensorid=4">'; ?>
                <img src="./public/assets/icon/battery.svg">
                Batterie
            </a>
        </div>
    </div>
</div>