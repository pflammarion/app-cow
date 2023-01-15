<?php
$ticket = $ticket ?? [];
print_r($ticket);
?>

<div class="ticket-update">
    <a>Retour</a>
    <?php
    if(isset($ticket['status_id'])){
       if($ticket['status_id'] === 1 || $ticket['status_id'] === 2){
           echo '<span>Traiter le ticket</span>';
           echo '<span>Fermer le ticket</span>';
       }
        if($ticket['status_id'] === 3){
            echo '<span>Réouvrir le ticket</span>';
        }
    }
    ?>
    <div class="ticket-container">
       <?php
       echo '<span>Créé le : ' . $ticket['creation'] .'</span>';
       if (isset($ticket['modif'])){
           echo '<span>Modifié le : ' . $ticket['modif'] .'</span>';
       }
       echo '<span>Statut : ' . $ticket['status'] .'</span>';
       echo '<span>Sujet : ' . $ticket['tag'] .'</span>';
       echo '<span class="ticket-content">' . $ticket['content'] .'</span>';
       echo '<a href="mailto:' . $ticket['email'] .'" class="email">Envoyer un email</a>';
       echo '<span>Email : ' . $ticket['email'] . '</span>'
       ?>
    </div>

</div>
