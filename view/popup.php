<div class="popup-container" id="popup"  onclick="hide(this)"></div>

<script>
    $(document).ready(() => {

        let i=0;
        <?php if(isset($_GET['error']) && $_GET['error'] !== ""){?>
            $(".popup-container").append('<div class="popup" id="number' + i + '"><?php echo htmlspecialchars($_GET['error']);?></div>');
            $('#number' + i).addClass('error');
            i++;
        <?php }?>
        <?php if(isset($_GET['success']) && $_GET['success'] !== ""){
            ?>
            $(".popup-container").append('<div class="popup" id="number' + i + '"><?php echo htmlspecialchars($_GET['success']);?></div>');
            $('#number' + i).addClass('success');
            i++;
        <?php }?>
        $('.popup').delay(5000).fadeOut('slow');
    });

    function hide(e){
        e.style.display = "none";
    }
</script>

