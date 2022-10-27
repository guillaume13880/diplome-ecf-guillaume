<?php
require_once './db.php';

session_start();

//si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}


//recupere le btn validation
$btnValidPerm = $_POST['btn-valid-perm'];
//recupere la session de l'admin
$sess2 =  $_SESSION['id-admin'];
$idPerm = (int)$_POST['id-perm'];


//si ces bien l'admin de connecter
if (isset($sess2)) {
    //au click du submit
    if (isset($btnValidPerm)) {
        //si input est saisie = 1 sinon egal 0
        if (isset($_POST['programme1'])) {
            $programme1 = 1;
        } else {
            $programme1 = 0;
        }
        if (isset($_POST['programme2'])) {
            $programme2 = 1;
        } else {
            $programme2 = 0;
        }
        if (isset($_POST['programme3'])) {
            $programme3 = 1;
        } else {
            $programme3 = 0;
        }
        if (isset($_POST['programme4'])) {
            $programme4 = 1;
        } else {
            $programme4 = 0;
        }
        if (isset($_POST['programme5'])) {
            $programme5 = 1;
        } else {
            $programme5 = 0;
        }
        if (isset($_POST['programme6'])) {
            $programme6 = 1;
        } else {
            $programme6 = 0;
        }
        $sql = "UPDATE `modules` SET `vendre_des_boissons`='$programme1',`envoyer_new`='$programme2',`gérer_les_plannings`='$programme3',`television`='$programme4',`music`='$programme5',`parking`='$programme6' WHERE id = ?";
        $preSql = $database->prepare($sql);
        $preSql->execute([$idPerm]);
        $_SESSION['changement-perm'] = "Modification des permissions de la franchise réussis !";
        header('Location: ./structures-page.php');
        
    }

} else {
    //sinon ce nes pas un admin creer un message d'erreur
    $_SESSION['error-perm'] = "Vous n'avais pas acces aux modification des permissions veuiller contacter l'administrateur : ";
    header('Location: ./structures-page.php');
}