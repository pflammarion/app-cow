<div class="cow-vache-add">
    <h1>Nouvelle Vache</h1>
    <form action="" method="post">
        <div class="form-cow-box">
            <div class="create-question">
                <label for="question">
                    Nom de la Vache :
                    <input type="text" name="name">
                </label>
                <label for="question">
                    Numéro de boitier :
                    <input type="text" name="number">
                </label>
            </div>
        </div>

        <div class="box-around-btn">
            <div class="btn-cow">
                <div>
                    <a href="user?page=vache">
                        <button type="submit" class="btn-valider">
                            Valider
                        </button>
                    </a>
                </div>
                <div>
                    <a href="user?page=vache">
                        <div class="btn-return">
                            <img src="./public/assets/icon/retour.svg" alt="retour">
                            Retour
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <input type="hidden" value="create" name="action">
    </form>
</div>
