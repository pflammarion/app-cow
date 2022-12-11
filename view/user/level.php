<?php
$current_level = $current_level ?? [];
?>

<form>
    <div class="level-container">
        <img src="./public/assets/icon/heart.svg">
        <div id="slider">
            <div id="custom-handle" class="ui-slider-handle"></div>
        </div>
    </div>
</form>

<script>
    $( function() {
        var handle = $( "#custom-handle" );
        $( "#slider" ).slider({
            create: function() {
                handle.text( $( this ).slider( "value" ) );
            },
            slide: function( event, ui ) {
                handle.text( ui.value );
            }
        });
    } );
</script>