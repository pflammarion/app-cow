<?php
$level = $current_level[0] ?? [];
print_r($level);

$img = '';
$reference = $level['reference'];
$first_level = $level['firstLevel'];
$second_level = $level['secondLevel'];
switch ($level['sensor']) {
    case 1:
        $img = '<img src="./public/assets/icon/heart.svg" alt="heart">';
        $min = 0;
        $max = 150;
        break;
    case 2:
        $img = '<img src="./public/assets/icon/air.svg" alt="air">';
        $min = 0;
        $max = 100;
        break;
    case 3:
        $img = '<img src="./public/assets/icon/sound.svg" alt="sound">';
        $min = 0;
        $max = 150;
        break;
    case 4:
        $img = '<img src="./public/assets/icon/battery.svg" alt="battery">';
        $min = 0;
        $max = 100;
        break;
}

?>

<div class="level">
    <div class="level-block">
        <h2>Modifier mes seuils</h2>
        <?php echo $img;?>
        <form id="level-form" action="" method="post">

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
            <span class="max">150</span>
        </div>
        <div class="caption">
            <p class="caption-first">Le seuil moyen est atteint en &#177;<span><?php echo $level['firstLevel']?></span></p>
            <p class="caption-second">Le seuil critique est atteint en &#177;<span><?php echo $level['secondLevel']?></span></p>
        </div>



        <div class="button-container">
            <?php echo '<a class="btn-edit" href="user?page=accueil&cow=' . $_GET['cow'] . '">Retour</a>'; ?>
            <?php echo '<a class="btn-delete" href="user?page=accueil&action=level&chipid='. $_GET['chipid'].'&cow=' . $_GET['cow'] . '" > Reset</a>'; ?>
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
    });

</script>
