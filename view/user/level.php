<?php
$current_level = $current_level ?? [];
?>

<div class="level">
    <h2>Modifier mes seuils</h2>
    <form id="level-form" action="" method="post">
        <?php
            foreach ($current_level as $level){
                if ($level['sensor']!== 4){
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
                        <div class="inline-slider">
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
                    </div>

                    <?php
                }
            }
        ?>

            <script>
                    function updateValue(min, mid, max, id){
                        let minid  = ('#custom-handle-min' + id).toString();
                        let minval = parseInt($(minid).text());
                        let midid  = ('#custom-handle-mid' + id).toString();
                        let midval = parseInt($(midid).text());
                        let maxid  = ('#custom-handle-max' + id).toString();
                        let maxval = parseInt($(maxid).text());
                        if(id === 4){
                            $(min).slider( "option", "min", midval);
                            $(mid).slider( "option", "min", maxval);
                            $(mid).slider( "option", "max", minval);
                            $(max).slider( "option", "max", midval);
                        }
                        else{
                            $(min).slider( "option", "max", midval);
                            $(mid).slider( "option", "min", minval);
                            $(mid).slider( "option", "max", maxval);
                            $(max).slider( "option", "min", midval);
                        }
                        setWidth(min);
                        setWidth(mid);
                        setWidth(max);
                    }

                    function setWidth(object){
                        let min = $(object).slider("option", "min");
                        let max = $(object).slider("option", "max");
                        let width = ((parseInt(max) - parseInt(min)) * 100)/150;
                        let percent = width.toString() + "%"
                        $(object).width(percent);
                    }

                    <?php
                    foreach ($current_level as $level){
                        if ($level['sensor']!== 4){
                    ?>

                    $( function() {
                        var handle = $( "#custom-handle-min<?php echo ($level['sensor']) ?>" );
                        $("#min<?php echo ($level['sensor']) ?>" ).slider({
                            min: 0,
                            max: <?php echo ($level['mid']) ?>,
                            value: <?php echo ($level['low']) ?>, //mettre la valeur de la bdd
                            create: function() {
                                handle.text( $( this ).slider( "value" ) );
                                setWidth("#min<?php echo ($level['sensor']) ?>")
                            },
                            slide: function( event, ui ) {
                                handle.text( ui.value );
                                updateValue("#min<?php echo ($level['sensor']) ?>", "#mid<?php echo ($level['sensor']) ?>", "#max<?php echo ($level['sensor']) ?>", <?php echo ($level['sensor']) ?>)
                            }
                        });
                    } );

                    $( function() {
                        var handle = $( "#custom-handle-mid<?php echo ($level['sensor']) ?>" );
                        $( "#mid<?php echo ($level['sensor']) ?>" ).slider({
                            min: <?php echo ($level['low']) ?>,
                            max: <?php echo ($level['high']) ?>,
                            value: <?php echo ($level['mid']) ?>, //mettre la valeur de la bdd
                            create: function() {
                                handle.text( $( this ).slider( "value" ) );
                                setWidth("#mid<?php echo ($level['sensor']) ?>")
                            },
                            slide: function( event, ui ) {
                                handle.text( ui.value );
                                updateValue("#min<?php echo ($level['sensor']) ?>", "#mid<?php echo ($level['sensor']) ?>", "#max<?php echo ($level['sensor']) ?>", <?php echo ($level['sensor']) ?>)
                            }
                        });
                    } );

                    $( function() {
                        var handle = $( "#custom-handle-max<?php echo ($level['sensor']) ?>" );
                        $( "#max<?php echo ($level['sensor']) ?>" ).slider({
                            min: <?php echo ($level['mid']) ?>,
                            max: 150,
                            value: <?php echo ($level['high']) ?>, //mettre la valeur de la bdd
                            create: function() {
                                handle.text( $( this ).slider( "value" ) );
                                setWidth("#max<?php echo ($level['sensor']) ?>")
                            },
                            slide: function( event, ui ) {
                                handle.text( ui.value );
                                updateValue("#min<?php echo ($level['sensor']) ?>", "#mid<?php echo ($level['sensor']) ?>", "#max<?php echo ($level['sensor']) ?>", <?php echo ($level['sensor']) ?>)
                            }
                        });
                    } );
                    <?php
                    }}
                    ?>
                </script>
        <div class="button-container">
            <?php echo '<a class="btn-exit" href="user?page=accueil&cow=' . $_GET['cow'] . '">Retour</a>'; ?>
            <?php echo '<a class="btn-red" href="user?page=accueil&action=level&chipid='. $_GET['chipid'].'&cow=' . $_GET['cow'] . '" > Reset</a>'; ?>
            <div class="btn-green" id="level-button">Valider les changements</div>
        </div>

    </form>
</div>

<script>
    $(document).ready(() => {

        $('#level-button').on('click', function (e){
            e.preventDefault();
            for(let i = 1; i <= 4; i++){
                let inputNameMin = ('min-' + i).toString()
                let minid  = ('#custom-handle-min' + i).toString();
                let minval = parseInt($(minid).text());
                $("<input>").attr({
                    name: inputNameMin,
                    type: "hidden",
                    value: minval
                }).appendTo("form");

                let inputNameMid = ('mid-' + i).toString()
                let midid  = ('#custom-handle-mid' + i).toString();
                let midval = parseInt($(midid).text());
                $("<input>").attr({
                    name: inputNameMid,
                    id: "hiddenId",
                    type: "hidden",
                    value: midval
                }).appendTo("form");

                let inputNameMax = ('max-' + i).toString()
                let maxid  = ('#custom-handle-max' + i).toString();
                let maxval = parseInt($(maxid).text());
                $("<input>").attr({
                    name: inputNameMax,
                    id: "hiddenId",
                    type: "hidden",
                    value: maxval
                }).appendTo("form");
            }
            $('#level-form').submit();

        })

    });
</script>
