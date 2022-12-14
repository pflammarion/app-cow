<?php
$current_level = $current_level ?? [];
?>

<div class="level">
    <div class="level-block">
    <h2>Modifier mes seuils</h2>
    <form id="level-form" action="" method="post">
        <?php
            foreach ($current_level as $level){
                $img = '';
                $reference = $level['reference'];
                $first_level = $level['firstLevel'];
                $second_level = $level['secondLevel'];
                switch ($level['sensor']){
                    case 1:
                        $img = '<img src="./public/assets/icon/heart.svg" alt="heart">';
                        break;
                    case 2:
                        $img = '<img src="./public/assets/icon/air.svg" alt="air">';
                        break;
                    case 3:
                        $img = '<img src="./public/assets/icon/sound.svg" alt="sound">';
                        break;
                    case 4:
                        $img = '<img src="./public/assets/icon/battery.svg" alt="battery">';
                        break;
                }

                ?>
                <div class="level-container">
                    <div class="plus-minus">
                        <?php echo $img?>
                        <input type="number"name="reference" class="reference" value="<?php echo $reference?>">
                    </div>
                    <div class="plus-minus">
                        <img src="./public/assets/icon/plus-or-minus.svg" alt="plus or minus">
                        <input type="number" name="first-level" class="first-level" value="<?php echo $first_level?>">
                    </div>
                    <div class="plus-minus">
                        <img src="./public/assets/icon/plus-or-minus.svg" alt="plus or minus">
                        <input type="number" name="second-level" class="second-level" value="<?php echo $second_level?>">
                    </div>
                </div>
        <?php
              }?>
        <div class="button-container">
            <?php echo '<a class="btn-edit" href="user?page=accueil&cow=' . $_GET['cow'] . '">Retour</a>'; ?>
            <?php echo '<a class="btn-delete" href="user?page=accueil&action=level&chipid='. $_GET['chipid'].'&cow=' . $_GET['cow'] . '" > Reset</a>'; ?>
            <div class="btn-green" id="level-button">Valider</div>
        </div>

    </form>
    </div>
</div>

<script>
    $(document).ready(() => {

    }

</script>
