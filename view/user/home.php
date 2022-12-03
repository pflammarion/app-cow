<?php
$sensors = $sensors ?? [];
$cow= $cow ?? [];

?>
<div class="home">
    <div class="box">
        <div class="sensor-box">
            <?php
                foreach ($sensors as $key => $sensor){
                    $class = '';
                    $type = '';
                    $img_url = '';
                    if ($sensor['value'] > $sensor['low']){
                        $class = 'low';
                    }
                    if ($sensor['value'] > $sensor['mid']){
                        $class = 'mid';
                    }
                    if ($sensor['value'] > $sensor['high']){
                        $class = 'high';
                    }
                    if($key === 'heart'){
                        $type = 'BPM';
                        $img_url = './public/assets/icon/heart.svg';
                    }
                    if($key === 'sound'){
                        $type = 'dB';
                        $img_url = './public/assets/icon/sound.svg';
                    }
                    if($key === 'air'){
                        $type = '%';
                        $img_url = './public/assets/icon/air.svg';
                    }
                    if($key === 'battery'){
                        $type = '%';
                        $img_url = './public/assets/icon/battery.svg';
                    }
                    echo '<div class="sensor '. $class . '">';
                    if ($img_url != '') echo '<img src="' . $img_url . '" alt="sensor">';
                    echo '<span>'.$sensor['value'] . " " . $type . '</span></div>';
                }
            ?>
        </div>
        <div class="selected-cow">
            <div class="cow-info">
                <h2><?php echo $cow['name']?></h2>
                <?php
                    if(!is_null($cow['img'])){
                        echo '<img src="' . $cow['img'] . '" class="cow-img">';
                    }
                    else echo '<div class="cow-img"></div>'
                ?>
                <p class="font-arima">N° <?php echo $cow['number']?></p>
            </div>
            <div class="alert"></div>
        </div>
        <div class="cows">
            <h2>Mes Vaches</h2>
        </div>
    </div>
</div>
