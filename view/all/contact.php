<?php
$connected = $connected ?? false;
$sujet = $sujet ?? [];
$tickets = $tickets ?? array(
    'content'=> null,
);
$email = $email ?? '';

?>


<div class="contact">
    <div class="container">
        <?php if($connected === true){?>
        <h2>Liste des tickets</h2>
        <div class="list">
            <?php
            foreach ($tickets as $ticket){
                 if ($ticket['status_id'] === 1) echo '<div class="ticket open">';
                else if ($ticket['status_id'] === 2) echo '<div class="ticket progress">';
                else if ($ticket['status_id'] === 3) echo '<div class="ticket closed">';
                else echo '<div class="container">';
                if(isset($ticket['content'])){
                    echo '<a title="Supprimer" href="all?page=contact&delete=1&ticket=' . $ticket['id'] .'" class="btn-blue">
                                <img class="img-black" src="./public/assets/icon/delete.svg" alt="Delete">
                                <img class="img-white" src="./public/assets/icon/delete-white.svg" alt="Delete">
                          </a>';
                    echo '<span>Créé le : ' . $ticket['creation'] .'</span>';
                    if (isset($ticket['modif'])){
                        echo '<span>Modifié le : ' . $ticket['modif'] .'</span>';
                    }
                    echo '<span>Statut : ' . $ticket['status'] .'</span>';
                    echo '<span>Sujet : ' . $ticket['tag'] .'</span>';
                    echo '<span>Contenu :<button class="afficher">Afficher</button></span>';
                    echo '<span class="ticket-content">' . $ticket['content'] .'</span>';
                }
                else echo "<span>Vous n'avez pas de ticket ouvert</span>";
                echo '</div>';
            }

            ?>
        </div>
        <span class="separator"></span>
        <?php } ?>
        <h2>Nous contacter</h2>
        <form action="" method="post">
            <label for="email">
                Email
                <input id="email" type="email" name="email" required="required" value="<?php if($connected === true){echo $email;}?>">
            </label>
            <label for="tag">
                Sujet
                <select name="tag" required>
                    <option value="" disabled selected>Choisir votre demande</option>
                    <?php
                        foreach ($sujet as $s){
                            echo '<option value="' . $s['id'] .'">' . $s['name'] . '</option>';
                        }
                    ?>
                </select>
            </label>
            <label for="content">
                Votre message
                <textarea name="content" required="required"></textarea>
            </label>

            <button id="sub" type="submit" class="btn-green">
                Envoyer
                <img src="./public/assets/icon/mail.svg" alt="Send icon">
            </button>
        </form>
        <span class="separator"></span>
        <h2>Contact téléphonique</h2>
        <a href="tel:+33652365615">+33 6 52 36 56 15</a>
    </div>
</div>

<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>

<script>
    $(document).ready(() => {
        $('.afficher').on('click', function (e){
            e.preventDefault()
            $(this).parent().siblings('.ticket-content').css('height', 'unset')
            $(this).parent().siblings('.ticket-content').css('display', 'block')
            $(this).css('display', 'none')
        })

        $('#sub').on('click', function (e){
            e.preventDefault();
            $("#overlay").fadeIn(300);
            $('form').submit();
        })
    });
</script>
