<?php $sensors = $sensors ?? []; ?>
<div class="home">
    <div class="box">
        <div class="sensor-box">
            <?php
                foreach ($sensors as $sensor){
                    $class = '';
                    if ($sensor['value'] > $sensor['low']){
                        $class = 'low';
                    }
                    if ($sensor['value'] > $sensor['mid']){
                        $class = 'mid';
                    }
                    if ($sensor['value'] > $sensor['high']){
                        $class = 'high';
                    }
                    echo '<div class="sensor'. $class . '">' . $sensor['value'] . '</div>';
                }
            ?>
        </div>
        <div>
            <div class="cow-info"></div>
            <div class="alert"></div>
        </div>
        <div class="cows">
            <h2>Mes Vaches</h2>
        </div>
    </div>
</div>
