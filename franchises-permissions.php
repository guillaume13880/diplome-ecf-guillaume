<?php
require_once './db.php';
include './get-franchises.php';

session_start();

//si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}


//recupere le btn validation
$btnValid = $_POST['btn-valid'];
//recupere la session de l'admin
$sess3 =  $_SESSION['id-admin'];
$idPerm = (int)$_POST['id-perm-glo'];



//si ces bien l'admin de connecter
if (isset($sess3)) {
    //au click du submit
    if (isset($btnValid)) {
        //si input est saisie = 1 sinon egal 0
        if (isset($_POST['programmer1'])) {
            $programmer1 = 1;
            
        } else {
            $programmer1 = 0;
        }
        if (isset($_POST['programmer2'])) {
            $programmer2 = 1;
        } else {
            $programmer2 = 0;
        }
        if (isset($_POST['programmer3'])) {
            $programmer3 = 1;
        } else {
            $programmer3 = 0;
        }
        if (isset($_POST['programmer4'])) {
            $programmer4 = 1;
        } else {
            $programmer4 = 0;
        }
        if (isset($_POST['programmer5'])) {
            $programmer5 = 1;
        } else {
            $programmer5 = 0;
        }
        if (isset($_POST['programmer6'])) {
            $programmer6 = 1;
        } else {
            $programmer6 = 0;
        }
        $sqlpr = "UPDATE `perm_global` SET `vendre_des_boissons`='$programmer1',`envoyer_new`='$programmer2',`gérer_les_plannings`='$programmer3',`television`='$programmer4',`music`='$programmer5',`parking`='$programmer6' WHERE id = ?";
        $preSql = $database->prepare($sqlpr);
        $preSql->execute([$idPerm]);
        $_SESSION['changement-perm-glo'] = "Modification des permissions globals de la franchise réussis !";
        header('Location: ./franchises-page.php');
        
    }

} else {
    //sinon ce nes pas un admin creer un message d'erreur
    $_SESSION['error-permission'] = "Vous n'avais pas acces aux modification des permissions veuiller contacter l'administrateur : ";
    header('Location: ./franchises-page.php');
}

