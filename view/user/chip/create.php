<div class="cow-vache-add">
    <h1>Nouveau Boitier</h1>
    <form action="" method="post">
        <div class="form-cow-box">
            <div class="create-question">
                <label for="question">
                    Numéro de boitier :
                    <input type="text" name="number">
                </label>

            </div>
        </div>

        <div class="box-around-btn">
            <div class="btn-cow">
                <form action="" method="post">
                    <input type="hidden" value="create" name="action" >
                    <div>
                        <a href="user?page=boitier">
                            <button type="submit" class="btn-valider">
                                Valider
                            </button>
                        </a>
                    </div>
                    <div>
                        <a href="user?page=boitier">
                            <div class="btn-return">
                                <img src="./public/assets/icon/retour.svg" alt="retour">
                                Retour
                            </div>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <input type="hidden" value="create" name="action">
    </form>
</div>
