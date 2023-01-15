<?php
$tickets = $tickets ?? [];
?>

<div class="ticket-view">
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
