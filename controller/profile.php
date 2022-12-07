<?php

$action = selectAction("view");

require __DIR__ . '/../model/profil.php';
require __DIR__.'/../model/function.php';

if(!empty($action)){
    $content = [];
    if (isset($_SESSION['user'])){
        $content = getUserProfile($_SESSION['user']);
    }
    $view = "profile/" . $action;

    if(isset($_POST['update']) && $_POST['update'] == 1){
        if (isset($_POST['username']) and isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email'])) {
            $values = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
            ];
            $update = updateProfile($values);

            if(isset($_POST['delete-img'])){
                $update = removeImage('user', $_SESSION['user']);
            }

            if (isset($_FILES) && $update){
                $filename   = uniqid() . "-" . time();
                $extension  = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION );
                $basename   = $filename . "." . $extension;
                $source       = $_FILES["file"]["tmp_name"];
                $destination  = "./uploads/{$basename}";
                $upload = True;
                if($extension != "jpg" && $extension != "png" && $extension!= "jpeg") {
                    echo 'ici';
                    $upload = False;
                }
                if ($_FILES["file"]["size"] > 5000000) {
                    echo 'too large';
                    $upload = False;
                }
                if($upload){
                    $update = updateImage("user", $destination, $_SESSION['user']);
                    if ($update){
                        move_uploaded_file( $source, $destination );
                    }
                }
            }
            if ($update) {
                header("Location: profil?action=view");
                exit();
            }
        }


    }

    include (showPage($view));
}
