<?php
$data = $content ??  [];
foreach ($data as $faq){
    if ($faq['id']==$_GET['id']){
        $box = $faq;
        }
}
?>
<div class="box-question">
    <div class="addquestion">
        <h1>Nouvelle question</h1>
        <form action="" method="post">
            <div class="form-create-box">
                <div class="question">
                    <label for="question">
                        Question
                        <input type="text" name="question" value="<?php echo $box["title"] ?>">
                    </label>
                </div>
                <div class="response">
                    <label for="response">
                        Réponse<br>
                        <textarea name="response"><?php echo $box["answer"] ?></textarea>
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
                            <img src="./public/assets/icon/retour.svg">
                            Retour
                        </div>
                    </a>
                </div>
            </div>
            <input type="text" value="update" name="action" style="display: none">
            <input type="text" value="<?php echo $_GET["id"] ?>" name="id" style="display: none">
        </form>
    </div>

</div>