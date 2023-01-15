<?php
$tickets = $tickets ?? [];

$lists = array();

foreach ($tickets as $item) {
    if (!isset($lists[$item['status_id']])) {
        $lists[$item['status_id']] = array();
    }
    $lists[$item['status_id']][] = $item;
}
?>

<div class="ticket-view">
    <?php
    foreach ($lists as $k => $tickets){
        if ($k === 1) echo '<div class="container open">';
        else if ($k === 2) echo '<div class="container progress">';
        else if ($k === 3) echo '<div class="container closed">';
        else echo '<div class="container open">';
    foreach ($tickets as $ticket){
        echo '<div>';
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
    echo '</div>';
    }

    ?>
</div>
