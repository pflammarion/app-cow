<div class="perm-create">
            <h1>Nouveau role</h1>
            <form action="" method="post">
                <label for="question">
                    Role
                    <input type="text" name="question">
                </label>
                <div class="btn-container">
                    <div>
                        <a href="/admin?page=permission&action=role">
                            <div class="btn-return">
                                <img src="./public/assets/icon/retour.svg" alt="retour">
                                Retour
                            </div>
                        </a>
                    </div>
                    <div class="btn-box-create">
                        <div>
                            <button type="submit" class="btn-valider">
                                Valider
                            </button>
                        </div>

                    </div>
                </div>

                <input type="hidden" value="create" name="action">

            </form>
</div>