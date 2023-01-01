<?php
$id = intval($_GET['sensorid']);
$current_level = $current_level ?? [];
$level = [];
foreach ($current_level as $current){
    if($current['sensor'] === $id) $level = $current ;
}

$min = 0;
$max = 0;
$img = '';
$reference = $level['reference'];
$first_level = $level['firstLevel'];
$second_level = $level['secondLevel'];
switch ($level['sensor']) {
    case 1:
        $img = '<img src="./public/assets/icon/heart.svg" alt="heart">';
        $max = 150;
        break;
    case 2:
        $img = '<img src="./public/assets/icon/air.svg" alt="air">';
        $max = 100;
        break;
    case 3:
        $img = '<img src="./public/assets/icon/sound.svg" alt="sound">';
        $max = 150;
        break;
    case 4:
        $img = '<img src="./public/assets/icon/battery.svg" alt="battery">';
        $max = 100;
        break;
}

?>

<div class="level">
    <div class="level-block">
        <h2>Modifier mes seuils</h2>
        <?php echo $img;?>
        <form id="level-form" action="" method="post">
            <?php if($level['sensor'] === 1 || $level['sensor'] === 3){?>
            <div class="level-container">
                <span class="min"><?php echo $min?></span>
                <div class="high-level-bar"></div>
                <div class="second-level-cursor-un cursor"><span><?php echo $level['reference'] - $level['secondLevel']?></span></div>
                <div class="mid-level-bar"></div>
                <div class="second-level-cursor-deux cursor"><span><?php echo $level['reference'] + $level['secondLevel']?></span></div>
                <div class="first-level-cursor-un cursor"><span><?php echo $level['reference'] - $level['firstLevel']?></span></div>
                <div class="low-level-bar "></div>
                <div class="ref-cursor cursor"><span><?php echo $level['reference']?></span></div>
                <div class="first-level-cursor-deux cursor"><span><?php echo $level['reference'] + $level['firstLevel']?></span></div>
                <span class="max"><?php echo $max?></span>
            </div>
            <?php }else{?>
                    <div class="level-overflow">
                        <div class="level-container">
                            <span class="min" style="left: 0"><?php echo $min?></span>
                            <div class="high-level-bar"></div>
                            <div class="second-level-cursor-un cursor"><span><?php echo $level['reference'] - $level['secondLevel']?></span></div>
                            <div class="mid-level-bar"></div>
                            <div class="second-level-cursor-deux cursor"><span><?php echo $level['reference'] + $level['secondLevel']?></span></div>
                            <div class="first-level-cursor-un cursor"><span><?php echo $level['reference'] - $level['firstLevel']?></span></div>
                            <div class="low-level-bar "></div>
                            <div class="ref-cursor cursor"><span style="left: -31px; top: -40px"><?php echo $level['reference']?></span></div>
                            <div class="first-level-cursor-deux cursor"><span><?php echo $level['reference'] + $level['firstLevel']?></span></div>
                            <span class="max" style="display: none"><?php echo $max?></span>
                        </div>
                    </div>
            <?php }?>
        <div class="caption">
            <p class="caption-first">Le seuil moyen est atteint en
                <?php
                if($level['sensor'] === 2 || $level['sensor'] === 4){
                        echo '-';
                    }
                else echo '&#177';
                ?>

                <span><?php echo $level['firstLevel']?></span>
                <?php if($level['sensor'] === 1){
                        echo 'BPM';
                    }
                    elseif($level['sensor'] === 2 || $level['sensor'] === 4){
                        echo '%';
                    }
                    elseif ($level['sensor']){
                        echo 'dB';
                    }
                ?>
            </p>
            <p class="caption-second">Le seuil critique est atteint en
                <?php
                if($level['sensor'] === 2 || $level['sensor'] === 4){
                        echo '-';
                    }
                else echo '&#177';
                ?>
               <span><?php echo $level['secondLevel']?></span>
                <?php if($level['sensor'] === 1){
                    echo 'BPM';
                }
                elseif($level['sensor'] === 2 || $level['sensor'] === 4){
                    echo '%';
                }
                elseif ($level['sensor']){
                    echo 'dB';
                }
                ?>
            </p>
        </div>

            <input name="sensor" type="hidden" value="<?php echo $level['sensor']?>">




        <div class="button-container">
            <?php echo '<a class="btn-edit" href="user?page=accueil&action=level_selector&chipid='.$_GET['chipid'].'&cow=' . $_GET['cow'] . '">Retour</a>'; ?>
            <?php echo '<a class="btn-delete" href="user?page=accueil&action=level&chipid='. $_GET['chipid'].'&cow=' . $_GET['cow'] . '&sensorid='.$_GET['sensorid'].'" > Reset</a>'; ?>
            <div class="btn-green" id="level-button">Valider</div>
        </div>

    </form>
    </div>
</div>

<script>
    $(document).ready(() => {
        //init

        let cursorRef = $('.ref-cursor');
        let cursorFirstUn = $('.first-level-cursor-un');
        let cursorFirstDeux = $('.first-level-cursor-deux');
        let cursorSecondUn = $('.second-level-cursor-un');
        let cursorSecondDeux = $('.second-level-cursor-deux');

        let largueurTotale = parseInt($('.level-container').width())
        let coef = largueurTotale/parseInt($('.max').text());
        let refCursor = parseInt(cursorRef.find('span').text())

        let initWidthFirst = $('.caption-first').find('span').text();
        $('.low-level-bar').width(initWidthFirst*coef*2);
        $('.low-level-bar').css('left', (cursorFirstUn.text() * coef));
        let initWidthSecond = $('.caption-second').find('span').text();
        $('.mid-level-bar').width(initWidthSecond*coef*2);
        $('.mid-level-bar').css('left', (cursorSecondUn.text() * coef));

        cursorRef.css('left', refCursor * coef)
        cursorFirstUn.css('left', (cursorFirstUn.text() * coef))
        cursorFirstDeux.css('left', (cursorFirstDeux.text() * coef))
        cursorSecondUn.css('left', (cursorSecondUn.text() * coef))
        cursorSecondDeux.css('left', (cursorSecondDeux.text() * coef))



        <?php if($level['sensor'] === 1 || $level['sensor'] === 3){?>

        $('.low-level-bar').draggable({
           axis:"x",
           drag: function() {
               //get element position
               var $this = $(this);
               var thisPos = $this.position();
               var x = thisPos.left;

               let width = parseInt($('.low-level-bar').width());
               let midWidth = parseInt($('.mid-level-bar').width());
               let midPos = x + (width/2) - (midWidth/2);
               let refCursor = x + width/2;

               let ref = parseInt(cursorRef.position().left/coef)

               cursorRef.css('left', refCursor)
               cursorFirstUn.css('left', x)
               cursorFirstDeux.css('left', x + width)
               $('.mid-level-bar').css('left', midPos)
               cursorSecondUn.css('left', midPos)
               cursorSecondDeux.css('left', midPos + midWidth)


               let currentDifMid = parseInt(($('.mid-level-bar').width()/2)/coef)
                   cursorSecondUn.find('span').text(ref - currentDifMid)
                   cursorSecondDeux.find('span').text(ref + currentDifMid)

               let currentDifLow = parseInt(($('.low-level-bar').width()/2)/coef)
                   cursorFirstUn.find('span').text(ref - currentDifLow)
                   cursorFirstDeux.find('span').text(ref + currentDifLow)
                //callback
               cursorRef.find('span').text(ref)

           }
       });
        <?php }?>
            $('.first-level-cursor-un').draggable({
                axis:"x",
                drag: function() {
                    //get element position ref to left
                    var $this = $(this);
                    var thisPos = $this.position();
                    var x = thisPos.left;

                    let ref = parseInt(cursorRef.text())
                    let dif = ((ref*coef) - x);
                    let w = dif * 2;

                    $('.low-level-bar').css('left', x)
                    $('.low-level-bar').css('width', w)
                    cursorFirstDeux.css('left', (ref*coef) + dif)
                    let currentDif = parseInt(($('.low-level-bar').width()/2)/coef)
                    cursorFirstUn.find('span').text(ref - currentDif);
                    cursorFirstDeux.find('span').text(ref + currentDif);
                    $('.caption-first').find('span').text(currentDif);
                }
            });

        $('.first-level-cursor-deux').draggable({
            axis:"x",
            drag: function() {
                var $this = $(this);
                var thisPos = $this.position();
                var x = thisPos.left;
                let ref = parseInt(cursorRef.text())
                let dif = (x - (ref*coef));
                let w = dif * 2;
                $('.low-level-bar').css('left', (ref*coef) - dif)
                $('.low-level-bar').css('width', w)
                cursorFirstUn.css('left', (ref*coef) - dif)
                let currentDif = parseInt(($('.low-level-bar').width()/2)/coef)
                cursorFirstUn.find('span').text(ref - currentDif)
                cursorFirstDeux.find('span').text(ref + currentDif)
                $('.caption-first').find('span').text(currentDif);
            }
        });

        $('.second-level-cursor-un').draggable({
            axis:"x",
            drag: function() {
                var $this = $(this);
                var thisPos = $this.position();
                var x = thisPos.left;

                let ref = parseInt(cursorRef.text())
                let dif = ((ref*coef) - x);
                let w = dif * 2;

                $('.mid-level-bar').css('left', x)
                $('.mid-level-bar').css('width', w)
                cursorSecondDeux.css('left', (ref*coef) + dif)
                let currentDif = parseInt(($('.mid-level-bar').width()/2)/coef)
                cursorSecondUn.find('span').text(ref - currentDif)
                cursorSecondDeux.find('span').text(ref + currentDif)
                $('.caption-second').find('span').text(currentDif);
            }
        });

        $('.second-level-cursor-deux').draggable({
            axis:"x",
            drag: function() {
                var $this = $(this);
                var thisPos = $this.position();
                var x = thisPos.left;
                let ref = parseInt(cursorRef.text())
                let dif = (x - (ref*coef));
                let w = dif * 2;
                $('.mid-level-bar').css('left', ref*coef - dif)
                $('.mid-level-bar').css('width', w)
                cursorSecondUn.css('left', ref*coef - dif)
                let currentDif = parseInt(($('.mid-level-bar').width()/2)/coef)
                cursorSecondUn.find('span').text(ref - currentDif)
                cursorSecondDeux.find('span').text(ref + currentDif)
                $('.caption-second').find('span').text(currentDif);

            }
        });


        // from submiting
        $('#level-button').on('click', function (e) {
            e.preventDefault();
                let inputNameRef = ('reference').toString()
                let refid = ('.ref-cursor').toString();
                let refval = parseInt($(refid).text());
                $("<input>").attr({
                    name: inputNameRef,
                    type: "hidden",
                    value: refval
                }).appendTo("form");

            let inputNameFirst = ('firstLevel').toString()
            let firstid = ('.caption-first').toString();
            let firstval = parseInt($(firstid).find('span').text());
            $("<input>").attr({
                name: inputNameFirst,
                type: "hidden",
                value: firstval
            }).appendTo("form");


            let inputNameSecond = ('secondLevel').toString()
            let secid = ('.caption-second').toString();
            let secval = parseInt($(secid).find('span').text());
            $("<input>").attr({
                name: inputNameSecond,
                type: "hidden",
                value: secval
            }).appendTo("form");

            $('#level-form').submit();
        });

        });

</script>
