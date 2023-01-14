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
                echo '<div class="ticket">';
                if(isset($ticket['content'])){
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
                <select name="tag">
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

            <button type="submit" class="btn-green">
                Envoyer
                <img src="./public/assets/icon/mail.svg" alt="Send icon">
            </button>
        </form>
        <span class="separator"></span>
        <h2>Contact téléphonique</h2>
        <p>+33 X XX XX XX XX</p>
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
    });
</script>
