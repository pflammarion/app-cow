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

    if (isset($_POST['delete']) && $action === 'delete'){
        $delete = deleteProfile();
        if ($delete){
            logout();
        }
    }

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
                header("Location: profil?action=update&success=L'image a bien été supprimée");
            }

            if (isset( $_FILES["file"] ) && !empty( $_FILES["file"]["name"] ) && $update){
                $filename   = uniqid() . "-" . time();
                $extension  = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION );
                $basename   = $filename . "." . $extension;
                $source       = $_FILES["file"]["tmp_name"];
                $destination  = "./uploads/{$basename}";
                $upload = True;
                if($extension != "jpg" && $extension != "png" && $extension!= "jpeg") {
                    $upload = False;
                    $update= False;
                    header("Location: profil?action=update&error=Le fichier n'a pas une extension acceptable");
                    exit();
                }
                if ($_FILES["file"]["size"] > 5000000) {
                    $upload = False;
                    $update= False;
                    header("Location: profil?action=update&error=La taille du fichier dépasse 5Mb");
                }
                if($upload){
                    $update = updateImage("user", $destination, $_SESSION['user']);
                    if ($update){
                        move_uploaded_file( $source, $destination );
                    }
                }
            }
            if ($update) {
                header("Location: profil?action=view&success=Votre profile a été mis à jour !");
                exit();
            }
        }


    }

    include (showPage($view));
}
