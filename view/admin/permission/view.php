<?php
$pages = $pages ??  [];
$roles = $roles ?? [];
$role_count = count($roles) - 1;

?>

<div class="permission-view">
    <table>
        <thead>
        <tr>
            <th>Pages</th>
            <?php foreach ($roles as $role){
                if($role['id']!==3){
                    echo '<th>' . $role['name'] .'</th>';
                }
            } ?>
        </tr>

        </thead>
        <tbody>
        <?php
        foreach ($pages as $page){
            echo '<tr>';
            echo '<th><p>' . $page['name'] .'</p></th>';
            for ($i = 0; $i < $role_count; $i++){
                echo '<th><input type="checkbox"></th>';
            }
            echo'</tr>';
        }
        ?>

        </tbody>
    </table>
</div>


