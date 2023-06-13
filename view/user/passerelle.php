<?php
$dict = $dict ?? [];
?>

<div class="passerelle">
    <?php
    foreach ($dict as $d){
        echo "Type : " . $d["type"];
        echo "<br />";
        echo "Valeur : " . $d["valeur"];
        echo "<br />";
        echo "<br />";
    }
    ?>
</div>
