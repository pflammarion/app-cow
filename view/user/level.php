<?php
$current_level = $current_level ?? [];
?>

<div class="level">
    <form>
        <div class="level-container">
            <img src="./public/assets/icon/heart.svg">
            <div id="min">
                <div id="custom-handle-min" class="ui-slider-handle"></div>
            </div>
            <div id="mid">
                <div id="custom-handle-mid" class="ui-slider-handle"></div>
            </div>
            <div id="max">
                <div id="custom-handle-max" class="ui-slider-handle"></div>
            </div>
        </div>
    </form>
</div>



<script>
    $( function() {
        var handle = $( "#custom-handle-min" );
        $( "#min" ).slider({
            max: 150,
            value: 127, //mettre la valeur de la bdd
            create: function() {
                handle.text( $( this ).slider( "value" ) );
            },
            slide: function( event, ui ) {
                handle.text( ui.value );
            }
        });
    } );


    $( function() {
        var handle = $( "#custom-handle-mid" );
        $( "#mid" ).slider({
            max: 150,
            value: 127, //mettre la valeur de la bdd
            create: function() {
                handle.text( $( this ).slider( "value" ) );
            },
            slide: function( event, ui ) {
                handle.text( ui.value );
            }
        });
    } );

    $( function() {
        var handle = $( "#custom-handle-max" );
        $( "#max" ).slider({
            max: 150,
            value: 127, //mettre la valeur de la bdd
            create: function() {
                handle.text( $( this ).slider( "value" ) );
            },
            slide: function( event, ui ) {
                handle.text( ui.value );
            }
        });
    } );
</script>