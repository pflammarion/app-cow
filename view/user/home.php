<?php
$sensors = $sensors ?? [];
$cow = $cow ?? [];
$cow_alerts = $cow_alerts ?? [];
$herd = $herd ?? [];
?>
<div class="home">
    <div class="box">
        <div class="sensor-box">
            <?php
                foreach ($sensors as $key => $sensor){
                    $class = '';
                    $type = '';
                    $img_url = '';

                    if($key === 'heart'){
                        $type = 'BPM';
                        $img_url = './public/assets/icon/heart.svg';
                        if ($sensor['value'] > $sensor['low']){
                            $class = 'low';
                        }
                        if ($sensor['value'] > $sensor['mid']){
                            $class = 'mid';
                        }
                        if ($sensor['value'] > $sensor['high']){
                            $class = 'high';
                        }
                    }
                    if($key === 'sound'){
                        $type = 'dB';
                        $img_url = './public/assets/icon/sound.svg';
                        if ($sensor['value'] > $sensor['low']){
                            $class = 'low';
                        }
                        if ($sensor['value'] > $sensor['mid']){
                            $class = 'mid';
                        }
                        if ($sensor['value'] > $sensor['high']){
                            $class = 'high';
                        }
                    }
                    if($key === 'air'){
                        $type = '%';
                        $img_url = './public/assets/icon/air.svg';
                        if ($sensor['value'] < $sensor['low']){
                            $class = 'low';
                        }
                        if ($sensor['value'] < $sensor['mid']){
                            $class = 'mid';
                        }
                        if ($sensor['value'] < $sensor['high']){
                            $class = 'high';
                        }
                    }
                    if($key === 'battery'){
                        $type = '%';
                        $img_url = './public/assets/icon/battery.svg';
                        if ($sensor['value'] < $sensor['low']){
                            $class = 'low';
                        }
                        if ($sensor['value'] < $sensor['mid']){
                            $class = 'mid';
                        }
                        if ($sensor['value'] < $sensor['high']){
                            $class = 'high';
                        }
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
            <div class="alert-box">
                <?php
                foreach ($cow_alerts as $cow_alert){
                    $date = new DateTime($cow_alert['date']);
                    $diff = $date->diff(new DateTime());
                    $hours = $diff->h;
                    $days = $diff->days;
                    echo '<div class="alert alert'. $cow_alert['type'] . '">';
                    echo '<span class="alert-date">' . $days . 'j ' . $hours . 'h</span>';
                    echo '<div class="alert-content">';
                    if ($cow_alert['status'] != 0) echo '<img src="./public/assets/icon/alert' . $cow_alert['type'] . '.svg" alt="alert">';
                    echo '<span class="alert-message">'.$cow_alert['message'].'</span></div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div class="cows">
            <h2>Mes Vaches</h2>
            <?php
                foreach ($herd as $cow){
                    if ($cow['id'] != $_GET['cow']) echo '<div class="herd alert alert' . $cow['level'] .'"><div class="herd-name"><img src="./public/assets/icon/cow.svg" alt="cow">' . $cow['name'] . '</div><img src="./public/assets/icon/alert' . $cow['level'] . '.svg" alt="alert"></div>';
                }
            ?>
        </div>
    </div>
</div>
