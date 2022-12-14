<?php
$current_level = $current_level ?? [];
?>

<div class="level">
    <div class="level-block">
    <h2>Modifier mes seuils</h2>
    <form id="level-form" action="" method="post">
        <?php
            foreach ($current_level as $level){
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
