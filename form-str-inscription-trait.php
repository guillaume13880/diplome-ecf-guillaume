<?php
require './db.php';
include './clean.php';

session_start();

    //si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}


$btnValide = $_POST['submit'];
$imgStr = clean($_POST['image-str']);
$nameStr = clean($_POST['name-str']);
$emailStr = clean($_POST['email-str']);
$postalStr = clean($_POST['address']);
$statutStr = clean($_POST['structure-active']);
$nameGerant = clean($_POST['name-gerant']);
$emailGerant = clean($_POST['email-gerant']);
$password = clean($_POST['password']);
$franchiseSelect = clean($_POST['choix-franchise']);
$permSelect = clean($_POST['choix-perm']);


if (isset($btnValide)) {

    if ((isset($imgStr) && !empty($imgStr)) && (isset($nameStr) && !empty($nameStr)) && (isset($emailStr) && !empty($emailStr)) && (isset($postalStr) && !empty($postalStr)) && (isset($statutStr) && !empty($statutStr)) && (isset($nameGerant) && !empty($nameGerant)) && (isset($emailGerant) && !empty($emailGerant)) && (isset($password) && !empty($password)) && (isset($franchiseSelect) && !empty($franchiseSelect)) && (isset($permSelect) && !empty($permSelect))) {
        //fonction pour hasher le mdp
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $requete = "INSERT INTO `structures`(`id`, `images`, `name`, `email_structures`, `address`, `structure_active`, `name_gerant`, `email_gerant`, `password_gerant`, `FK_franchise`, `FK_module`) VALUES ('', '$imgStr','$nameStr','$emailStr','$postalStr', '$statutStr','$nameGerant', '$emailGerant', '$hash','$franchiseSelect','$permSelect')";
        $prepare = $database-> prepare($requete);
        $prepare->execute();

        $_SESSION['creationStr'] = "Création de la structure <strong>" . $nameStr . "</strong> réussie !";
        header('Location: ./structures-page.php');
        


    } else {
        $_SESSION['error-str'] = "Saisie incorrect";
        header('Location: ./form-str-inscription.php');
    }
 
}