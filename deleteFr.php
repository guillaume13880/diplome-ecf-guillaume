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

//si ces bien l'admin de connecter
if (isset($sess2)) {
    if(isset($btnsuppr)) {
        $requeteDelete = "DELETE FROM `franchises` WHERE id = ?";
    }
    
}else {
    //sinon ce nes pas un admin creer un message d'erreur
    $_SESSION['error-supp'] = "Vous n'avais pas acces aux suppressions d'un partenaire veuiller contacter l'administrateur : " ;
    header('Location: ./franchises-page.php');
    
}
