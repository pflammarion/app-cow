<?php
include('controller.function.test.php');
echo '<link rel="stylesheet" href="./index.css">';

echo '<div>Testing selectPage()...</div>';
if(testSelectPageGet('test')){
    echo '<span class="passed">Test 1/2 passed</span><br>';
    if (testSelectPageEmpty('test')){
        echo '<span class="passed">Test 2/2 passed</span>';
    }
    else echo '<span class="failed">Test 2/2 failed</span>';
}
else echo '<span class="failed">Failed</span>' ;

echo '<div>Testing selectAction()...</div>';

if(testSelectActionGet('test')){
    echo '<span class="passed">Test 1/2 passed</span><br>';
    if (testSelectActionEmpty('test')){
        echo '<span class="passed">Test 2/2 passed</span>';
    }
    else echo '<span class="failed">Test 2/2 failed</span>';
}
else echo '<span class="failed">Failed</span>' ;


echo '<div>Testing showPage()...</div>';

if(testShowPage('header')){
    echo '<span class="passed">Test 1/2 passed</span><br>';
    if (!testShowPage('test')){
        echo '<span class="passed">Test 2/2 passed</span>';
    }
    else echo '<span class="failed">Test 2/2 failed</span>';
}
else echo '<span class="failed">Failed</span>' ;
