<?php
$data_trame = $data_trame ?? [];
?>

<div class="passerelle">
    <p>Les dernieres valeurs du micro</p>
    <?php
    foreach ($data_trame as $d){
        if($d['log_capteur'] == 5){
            echo "Valeur : " . $d["log_valeur"];
            echo "Date : " . $d["log_date"];
            echo "<br />";
        }
    }
    ?>
</div>
