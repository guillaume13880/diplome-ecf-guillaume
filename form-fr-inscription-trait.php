<?php
require './db.php';
include './clean.php';

    //si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}

session_start();
$btnValide = $_POST['submit'];
$imgFr = clean($_POST['image-fr']);
$nameFr = clean($_POST['name-fr']);
$emailFr = clean($_POST['email-fr']);
$postalFr = clean($_POST['code-postal']);
$statutFr = clean($_POST['franchises-active']);
$nameGerant = clean($_POST['name-gerant']);
$emailGerant = clean($_POST['email-gerant']);
$password = clean($_POST['password']);
$adminSelect = clean($_POST['choix-admin']);
$permSelect = clean($_POST['choix-perm']);


if (isset($btnValide)) {

    if ((isset($imgFr) && !empty($imgFr)) && (isset($nameFr) && !empty($nameFr)) && (isset($emailFr) && !empty($emailFr)) && (isset($postalFr) && !empty($postalFr)) && (isset($statutFr) && !empty($statutFr)) && (isset($nameGerant) && !empty($nameGerant)) && (isset($emailGerant) && !empty($emailGerant)) && (isset($password) && !empty($password)) && (isset($adminSelect) && !empty($adminSelect)) && (isset($permSelect) && !empty($permSelect))) {
        //fonction pour hasher le mdp
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $requete = "INSERT INTO `franchises`(`id`, `images`, `name`, `email-franchises`, `code_postale`, `franchises_active`, `name_gerant`, `email_gerant`, `password_gerant`, `FK_admin`, `FK_perm_global`) VALUES ('', '$imgFr','$nameFr','$emailFr','$postalFr', '$statutFr','$nameGerant', '$emailGerant', '$hash','$adminSelect','$permSelect')";
        $prepare = $database-> prepare($requete);
        $prepare->execute();

        $_SESSION['creationFr'] = "Création de la franchise " . $nameFr . " réussie !";
        header('Location: ./franchises-page.php');
        


    } else {
        $_SESSION['error-fr'] = "Saisie incorrect";
        header('Location: ./form-fr-inscription.php');
    }
 
}