<?php $roles = $roles ??  []; ?>
<div class="user-admin-create">
    <div class="box-user">
        <div class="add-user">
            <h1>Nouvel utilisateur</h1>
            <form action="" method="post">
                <div class="form-create-box">
                        <div class="create-user">
                            <label for="user">
                                Nom
                                <input type="text" name="LastName">
                            </label>
                            <label for="user">
                                Prénom
                                <input type="text" name="FirstName"
                            </label>
                            <label for="user">
                                Nom d'utilisateur
                                <input type="text" name="UserName"
                            </label>
                            <label for ="user">
                                Adresse mail
                                <input type="email" name="mail"
                            </label>
                        <label for="role">
                            Rôle<br>
                            <select>
                                <?php
                                foreach ($roles as $role){
                                        echo '<option>' . $role['name'] .'</option>';
                                } ?>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="btn-box-create">
                    <div>
                        <button type="submit" class="btn-valider">
                            Valider
                        </button>
                    </div>
                    <div>
                        <a href="admin?page=user">
                            <div class="btn-return">
                                <img src="./public/assets/icon/retour.svg" alt="retour">
                                Retour
                            </div>
                        </a>
                    </div>
                </div>
                <input type="hidden" value="create" name="action">

            </form>
        </div>

    </div>
</div>
