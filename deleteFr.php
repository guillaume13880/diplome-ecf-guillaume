<?php
require_once './db.php';
include './get-franchises.php';

session_start();

    //si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}

//recup la session de l'admin
$sess2 =  $_SESSION['id-admin'];
$btnsuppr = $_POST['btnDelete'];
$idSup = (int)$_POST['id-card-sup'];

//si ces bien l'admin de connecter
if (isset($sess2)) {
    if(isset($btnsuppr)) {
        $requeteDelete = "DELETE FROM `franchises` WHERE id = ?";
        $prepa = $database->prepare($requeteDelete);
        $prepa->execute([$idSup]);
        $_SESSION['delete-fr'] = "Suppression de la franchise réussi !";
        header('Location: ./franchises-page.php');
    }
    
}else {
    //sinon ce nes pas un admin creer un message d'erreur
    $_SESSION['error-modif'] = "Vous n'avais pas acces aux suppressions des franchises veuiller contacter l'administrateur : " ;
    header('Location: ./franchises-page.php');
    
}
