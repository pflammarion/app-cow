<div class="cow-vache-add">
    <h1>Nouvelle Vache</h1>
    <form action="" method="post">
        <div class="form-cow-box">
            <div class="create-question">
                <label for="question">
                    Nom de la Vache :
                    <input type="text" name="name" required="required">
                </label>
                <label for="question">
                    Numéro de la vache :
                    <input type="text" name="number" required="required">
                </label>
            </div>
        </div>

        <div class="box-around-btn">
            <div class="btn-cow">

                <a href="user?page=vache" class="btn-return">
                    <img src="./public/assets/icon/retour.svg" alt="retour">
                    Retour
                </a>
                        <button type="submit" class="btn-valider">
                            Valider
                        </button>

            </div>
        </div>
        <input type="hidden" value="create" name="action">
    </form>
</div>
