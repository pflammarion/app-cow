<div class="addquestion">
    <h1>Nouvelle question</h1>
    <form action="" method="post">

        <div class="question">
            <label for="question">
                Question
                <input type="text" >
            </label>
        </div>

        <div class="reponse">
            <label for="reponse">
                Réponse<br>
                <textarea></textarea>
            </label>
        </div>

    </form>
</div>
<a href="admin?page=faq" >
<button type="submit" class="btn-return">
        <img src="./public/assets/icon/retour.svg">
        Retour
</button>
</a>
<a href="admin?page=faq" >
    <button type="submit" class="btn-valider">
        Valider
    </button>
</a>

<?php

echo '<h1>FAQ create</h1>';
