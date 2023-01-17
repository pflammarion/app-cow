<?php
if (isset($_GET['cow'])){
    $type = 'cow';
}
else $type = 'chip';
$select = $select ?? [];
?>
<form action="" method="post" class="chip-cow-link">
    <?php if($type === 'cow'){ ?>
            <input type="hidden" name="cow" value="<?php echo intval($_GET['cow']) ?>">
        <input type="hidden" name="type" value="<?php echo $type ?>">
        <h1>Lier votre vache à un boitier</h1>
        <select name="chip">
            <?php
            foreach ($select as $option){
                echo '<option value="' . $option['id'] . '">' . $option['number']. '</option>';
            }
            ?>
        </select>
    <?php } ?>

    <?php if($type === 'chip'){ ?>
        <input type="hidden" name="chip" value="<?php echo intval($_GET['chip']) ?>">
        <input type="hidden" name="type" value="<?php echo $type ?>">
        <h1>Lier votre boitier à une vache</h1>
        <select name="cow" >
            <?php
            foreach ($select as $option){
                echo '<option value="' . $option['id'] . '">' . $option['name'] . ' '. $option['number']. '</option>';
            }
            ?>
        </select>
    <?php } ?>

    <div class="btn-cow">
        <?php
        if ($type === 'cow') echo '<a href="user?page=cow" class="btn-return">';
        else echo '<a href="user?page=boitier" class="btn-return">';
        ?>
            <img src="./public/assets/icon/retour.svg" alt="retour">
            Retour
        </a>
        <button type="submit" class="btn-valider">
            Valider
        </button>

    </div>
</form>
