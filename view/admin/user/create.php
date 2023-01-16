<?php $roles = $roles ??  []; ?>
<div class="user-admin-create">
            <h1>Nouvel utilisateur</h1>
            <form action="" method="post">
                        <div class="create-user">
                            <label for="lastname">
                                Nom
                                <input type="text" name="lastname">
                            </label>
                            <label for="firstname">
                                Prénom
                                <input type="text" name="firstname">
                            </label>
                            <label for="username">
                                Nom d'utilisateur
                                <input type="text" name="username">
                            </label>
                            <label for ="email">
                                Adresse mail
                                <input type="email" name="email">
                            </label>
                        <label for="role">
                            Rôle
                            <select name="role">
                                <?php
                                foreach ($roles as $role){
                                        echo '<option value="' . $role['id'] . '">' . $role['name'] .'</option>';
                                } ?>
                            </select>
                        </label>
                    </div>

                <div class="btn-box-create">
                    <a href="admin?page=user">
                        <div class="btn-return">
                            <img src="./public/assets/icon/retour.svg" alt="retour">
                            Retour
                        </div>
                    </a>
                        <button type="submit" class="btn-valider">
                            Valider
                        </button>

                </div>
                <input type="hidden" value="create" name="action">

            </form>
</div>
