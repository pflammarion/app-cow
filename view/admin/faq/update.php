<?php
$data = $content ??  [];
foreach ($data as $faq){
    if ($faq['id']===intval($_GET['id'])){
        $box = $faq;
    }
}
?>
<div class="faq-admin-update">
    <div class="box-question">
        <div class="add-question">
            <h1 class="update-faq-admin-title">Modification de la question</h1>
            <form action="" method="post">
                <div class="form-create-box">
                    <div class="question">
                        <label for="question">
                            Question
                            <input type="text" name="question" value="<?php if(isset($box))echo $box["title"] ?>">
                        </label>
                    </div>
                    <div class="response">
                        <label for="response">
                            Réponse<br>
                            <textarea name="response"><?php if(isset($box))echo $box["answer"] ?></textarea>
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
                <input type="hidden" value="update" name="action">
                <input type="hidden" value="<?php echo intval( $_GET["id"]) ?>" name="id">
            </form>
        </div>

    </div>
</div>