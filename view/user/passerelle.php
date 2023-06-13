<?php
$dict = $dict ?? [];
?>

<div class="passerelle">
    <p>Les dernieres valeurs du micro</p>
    <?php
    foreach ($dict as $d){
        if($d['type'] == 5){
            echo "Valeur : " . $d["valeur"];
            echo "<br />";
        }
    }
    ?>
</div>
