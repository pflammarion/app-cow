<?php
$sensors = $sensors ?? [];
$cow = $cow ?? [];
$cow_alerts = $cow_alerts ?? [];
$herd = $herd ?? [];
$chipId = $chipId ?? 0;
?>
<div class="home">
    <div class="box">
        <div class="show-cow">
            <div class="sensor-box">
                <div class="sensor-box-header">
                    <h2>Dernières données</h2>
                    <?php
                    if($chipId !== 0){
                        echo '<a class="btn-blue" href="user?page=accueil&action=level&chipid='.$chipId.'&cow=' . $_GET['cow'] . '" ><img src="./public/assets/icon/setting.svg" alt="Edit Level"></a>';
                    }
                echo '</div>';
                foreach ($sensors as $key => $sensor){
                    $date = new DateTime($sensor['date']);
                    $diff = $date->diff(new DateTime());
                    $hours = $diff->h . 'h';
                    $days = $diff->days . 'j';
                    $class = 'empty-center';
                    $type = 'Vide';
                    $img_url = '';
                    $val = '';
                    if (isset($sensor['value'])){
                        $val = $sensor['value'];
                        $class = '';
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
                    }


                    if($key!== 'battery') echo '<a href="user?page=tableau&type=' . $key  . '">';
                    echo '<div class="sensor '. $class . '">';
                    echo '<span class="time">' . $days . ' ' . $hours . '</span>';
                    if ($img_url != '') echo '<img src="' . $img_url . '" alt="sensor">';
                    echo '<span>'. $val . " " . $type . '</span></div>';
                    if($key!== 'battery') echo '</a>';
                }
                ?>
            </div>
            <div class="selected-cow">
                <h2>Vache sélectionnée</h2>
                <div class="cow-info">
                    <?php
                    if($cow !== []){
                        echo $cow['name'];
                        if(!is_null($cow['img'])){
                            echo '<img src="' . $cow['img'] . '" class="cow-img">';
                        }
                        else echo '<div class="cow-img"></div>';
                        echo '<p class="font-arima">N°' . $cow['number'] . '</p>';
                    }

                    else {
                        echo '<p class="cow-message">Aucune vache sélectionnée</p>';
                        echo '<div class="cow-img"></div>';
                        echo '';
                    }
                    ?>
                </div>
                <div class="alert-box">
                    <?php
                    foreach ($cow_alerts as $cow_alert){
                        $date = new DateTime($cow_alert['date']);
                        $diff = $date->diff(new DateTime());
                        $hours = $diff->h;
                        $days = $diff->days;
                        if ($cow_alert['status'] != 0) echo '<div class="alert alert'. $cow_alert['type'] . ' not-viewed">';
                        else echo '<div class="alert alert'. $cow_alert['type'] . '">';
                        echo '<span class="alert-date">' . $days . 'j ' . $hours . 'h</span>';
                        echo '<div class="alert-content">';
                        if ($cow_alert['status'] != 0) echo '<img id="imgAlert" src="./public/assets/icon/alert' . $cow_alert['type'] . '.svg" alt="alert" class="img-anim">';
                        echo '<span class="alert-message">'.$cow_alert['message'].'</span></div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="cows">
            <h2>Mes Vaches</h2>
            <div class="cow-scroller">
                <?php
                foreach ($herd as $cow){
                    if ($cow['id'] != $_GET['cow']){
                        if (isset($cow['level'])) echo '<a href="user?page=accueil&cow=' . $cow['id'] . '"><div class="herd alert alert' . $cow['level'] .'"><div class="herd-name"><img src="./public/assets/icon/cow.svg" alt="cow">' . $cow['name'] . '</div><img src="./public/assets/icon/alert' . $cow['level'] . '.svg" alt="alert"></div></a>';
                        else echo '<a href="user?page=accueil&cow=' . $cow['id'] . '"><div class="herd alert"><div class="herd-name"><img src="./public/assets/icon/cow.svg" alt="cow">' . $cow['name'] . '</div></div></a>';
                    }
                }
                if(sizeof($herd) === 0){
                    echo '<p>Vous n\'avez pas de vache enregistrée</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    $( ".not-viewed" ).click(function() {
        $(this).removeClass('not-viewed');
        $(this).find('img').css('display', 'none');
    });
</script>
