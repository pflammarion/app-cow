<head>
    <link rel="stylesheet" href="./index.css">
</head>
<h1>Page de test de fonction</h1>
<form method="post" action="">
    <input type="text" value="1" name="test" style="display: none">
    <button class="button" type="submit">Lancer les tests</button>
</form>

<a href="index.php" class="button">Reset</a>



<?php
if(isset($_POST['test']) && $_POST['test'] == 1){
    include('controller.function.test.php');
    echo '<div class="flex">';
    echo '<div>Testing selectPage()...<br>';
    if(testSelectPageGet('test')){
        echo '<span class="passed">Test 1/2 passed ✓</span><br>';
        if (testSelectPageEmpty('test')){
            echo '<span class="passed">Test 2/2 passed ✓</span>';
        }
        else echo '<span class="failed">Test 2/2 failed ❌</span>';
    }
    else echo '<span class="failed">Failed ❌</span>' ;
    echo '</div>';

    echo '<div>Testing selectAction()...<br>';

    if(testSelectActionGet('test')){
        echo '<span class="passed">Test 1/2 passed ✓</span><br>';
        if (testSelectActionEmpty('test')){
            echo '<span class="passed">Test 2/2 passed ✓</span>';
        }
        else echo '<span class="failed">Test 2/2 failed ❌</span>';
    }
    else echo '<span class="failed">Faile ❌d</span>' ;
    echo '</div>';


    echo '<div>Testing showPage()...<br>';

    if(testShowPage('header')){
        echo '<span class="passed">Test 1/2 passed ✓</span><br>';
        if (!testShowPage('test')){
            echo '<span class="passed">Test 2/2 passed ✓</span>';
        }
        else echo '<span class="failed">Test 2/2 failed ❌</span>';
    }
    else echo '<span class="failed">Failed ❌</span>' ;
    echo '</div>';
    echo '</div>';
}

