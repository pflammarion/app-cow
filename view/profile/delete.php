<?php $data = $content ?? []; ?>
<div class="profil-delete">
    <h1>Bonjour <?php echo $data['firstname']?></h1>
    <p>Êtes-vous sûr de vouloir supprimer votre profil ?</p>
    <form action="" method="post">
        <a class="btn btn-green">non</a>
        <button type="submit" class="btn btn-delete">oui</button>
    </form>
</div>

