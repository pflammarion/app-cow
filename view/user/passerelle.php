<?php
$data_tab = $data_tab ?? [];
?>

<div class="passerelle">
    <?php
    foreach ($data_tab as $d){
        echo $d;
        echo "<br />";
    }
    ?>
</div>
