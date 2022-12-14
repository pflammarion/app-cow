<div class="faq-admin-create">
    <div class="box-question">
        <div class="add-question">
            <h1>Nouvelle question</h1>
            <form action="" method="post">
                <div class="form-create-box">
                    <div class="create-question">
                        <label for="question">
                            Question
                            <input type="text" name="question">
                        </label>
                    </div>
                    <div class="create-question">
                        <label for="response">
                            Réponse<br>
                            <textarea name="response"></textarea>
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
                        <a href="admin?page=faq">
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





