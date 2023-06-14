<?php
$data_trame = $data_trame ?? [];
?>

<div class="passerelle">
    <p>Les dernieres valeurs du micro</p>
    <?php
    foreach ($data_trame as $d){
        if($d['log_capteur'] == 5){

            echo "<br />";
            echo "<br />";
            echo "Valeur : " . $d["log_valeur"];
            echo "<br />";
            echo "Date : " . $d["log_date"];
            echo "<br />";
            echo "---------------";
            echo "<br />";
            echo "<br />";
        }
    }
    ?>
</div>
