<?php
$pages = $pages ??  [];
$roles = $roles ?? [];
$roles = array_filter($roles, function ($obj) {
    return $obj['id'] !== 3;
});
$roles = array_values($roles);
$perms = $perms ?? [];
?>

<form action="" method="post" class="permission-view">
    <div class="button-container">
        <div>
            <a href="admin?page=permission&action=role">
                <div class="btn-return">
                    Rôles
                </div>
            </a>
        </div>
        <div>
            <button type="submit" class="btn-valider">
                Sauvegarder
            </button>
        </div>
    </div>
    <table>
        <thead>
        <tr>
            <th>Pages</th>
            <?php for ($i = 0; $i < count($roles); $i++){
                echo '<th data-id="'. $roles[$i]['id'] .'" data-index="'. $i .'">' . $roles[$i]['name'] .'</th>';
            } ?>
        </tr>

        </thead>
        <tbody>
        <?php
        foreach ($pages as $page){
            echo '<tr data-id="'. $page['id'] .'">';
            echo '<th><p>' . $page['name'] .'</p></th>';
            for ($i = 0; $i < count($roles); $i++){
                echo '<th><input name="checkbox[]" type="checkbox"></th>';
            }
            echo'</tr>';
        }
        ?>

        </tbody>
    </table>
</form>

<script>
    $(document).ready(() => {
        let permissions = [];
        permissions = <?php echo json_encode($perms, JSON_NUMERIC_CHECK);?> ;
        //loop in permission
        for(let i = 0; i < permissions.length; i++){
            let page = permissions[i]['page'];
            let role = permissions[i]['role'];
            if($('tr').filter('[data-id="' + page +'"]').length){
                let index = $('thead').find('th').filter('[data-id="' + role +'"]').data('index');
                $('tr').filter('[data-id="' + page +'"]').find('input[type="checkbox"]').eq(index).attr('checked', 'checked');
            }
        }

        $('table input[type=checkbox]').each(function () {
            let page = $(this).closest('tr').data('id');
            let indexParent = $(this).parent().index();
            let role = $('table thead tr th').eq(indexParent).data('id');
            $(this).val(page + '-' + role);
        });

    });
</script>


