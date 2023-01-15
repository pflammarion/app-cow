<?php
$ticket = $ticket ?? [];
?>

<div class="ticket-update">
    <div class="btn-container">
        <a href="admin?page=ticket" class="btn-edit">
            <img src="./public/assets/icon/retour.svg" alt="retour">
            Retour
        </a>
        <div class="ticket-status">
    <?php
    if(isset($ticket['status_id'])){
       if($ticket['status_id'] === 1 || $ticket['status_id'] === 2){
           echo '<span class="progress">Traiter le ticket</span>';
           echo '<span class="closed">Fermer le ticket</span>';
       }
        if($ticket['status_id'] === 3){
            echo '<span class="open">Réouvrir le ticket</span>';
        }
    }
    ?></div>
    </div>
    <div class="ticket-container">
       <?php
       echo '<span>Créé le : ' . $ticket['creation'] .'</span>';
       if (isset($ticket['modif'])){
           echo '<span>Modifié le : ' . $ticket['modif'] .'</span>';
       }
       echo '<span>Statut : ' . $ticket['status'] .'</span>';
       echo '<span>Sujet : ' . $ticket['tag'] .'</span>';
       echo '<span class="ticket-content">"' . $ticket['content'] .'"</span>';
       echo '<a href="mailto:' . $ticket['email'] .'" class="email">Envoyer un email</a>';
       echo '<span>Email : ' . $ticket['email'] . '</span>'
       ?>
    </div>

</div>
