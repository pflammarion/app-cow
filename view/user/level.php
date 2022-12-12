<?php
$current_level = $current_level ?? [];
?>

<div class="level">
    <h2>Modifier mes seuils</h2>
    <form>
        <?php
            foreach ($current_level as $level){
                ?>
                <div class="level-container">
                    <?php
                    switch ($level['sensor']){
                        case 1:
                            echo '<img src="./public/assets/icon/heart.svg">';
                            break;
                        case 2:
                            echo '<img src="./public/assets/icon/air.svg">';
                            break;
                        case 3:
                            echo '<img src="./public/assets/icon/sound.svg">';
                            break;
                        case 4:
                            echo '<img src="./public/assets/icon/battery.svg">';
                            break;
                    }
                        ?>
                    <div id="min<?php echo ($level['sensor']) ?>" class="slider min">
                        <div id="custom-handle-min<?php echo ($level['sensor']) ?>" class="ui-slider-handle"></div>
                    </div>
                    <div id="mid<?php echo ($level['sensor']) ?>" class="slider mid">
                        <div id="custom-handle-mid<?php echo ($level['sensor']) ?>" class="ui-slider-handle"></div>
                    </div>
                    <div id="max<?php echo ($level['sensor']) ?>" class="slider max">
                        <div id="custom-handle-max<?php echo ($level['sensor']) ?>" class="ui-slider-handle"></div>
                    </div>
                </div>


                <script>

                    $( function() {
                        var handle = $( "#custom-handle-min<?php echo ($level['sensor']) ?>" );
                        $( "#min<?php echo ($level['sensor']) ?>" ).slider({
                            max: 150,
                            value: <?php echo ($level['low']) ?>, //mettre la valeur de la bdd
                            create: function() {
                                handle.text( $( this ).slider( "value" ) );
                            },
                            slide: function( event, ui ) {
                                handle.text( ui.value );
                            }
                        });
                    } );

                    $( function() {
                        var handle = $( "#custom-handle-mid<?php echo ($level['sensor']) ?>" );
                        $( "#mid<?php echo ($level['sensor']) ?>" ).slider({
                            max: 150,
                            value: <?php echo ($level['mid']) ?>, //mettre la valeur de la bdd
                            create: function() {
                                handle.text( $( this ).slider( "value" ) );
                            },
                            slide: function( event, ui ) {
                                handle.text( ui.value );
                            }
                        });
                    } );

                    $( function() {
                        var handle = $( "#custom-handle-max<?php echo ($level['sensor']) ?>" );
                        $( "#max<?php echo ($level['sensor']) ?>" ).slider({
                            max: 150,
                            value: <?php echo ($level['high']) ?>, //mettre la valeur de la bdd
                            create: function() {
                                handle.text( $( this ).slider( "value" ) );
                            },
                            slide: function( event, ui ) {
                                handle.text( ui.value );
                            }
                        });
                    } );

                </script>
                <?php
            }
        ?>

        <button type="submit" name="level" class="btn-green">Valider les changements</button>
    </form>
</div>
