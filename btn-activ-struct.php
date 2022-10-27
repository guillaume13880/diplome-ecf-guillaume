<?php
require_once './db.php';
include './get-structures.php';

session_start();

    //si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}


//recup le btn vraie est faux
$activeStruct = $_POST['type1'];
$sess2 =  $_SESSION['id-admin'];
$idStruct = (int)$_POST['id-card-struct'];
//var_dump($idStruct);



//si ces bien l'admin de connecter
if (isset($sess2)) {
        //si le bouton est vraie
        if ($activeStruct == 'TRUE') {
            
            //modifie dans la base vraie en fonction de la session id a la connexion
            $inseStruct = "UPDATE `structures` SET `structure_active`= 1 WHERE id = ?";
            $prepStruct = $database->prepare($inseStruct);
            $prepStruct->execute([$idStruct]);
            $_SESSION['modification'] = "Activation de la franchise réussie ! " ;
            header('Location: ./structures-page.php');
            
        } else {
        
            $inseStruct1 = "UPDATE `structures` SET `structure_active`= 0 WHERE id = ?";
            $prepStruct1 = $database->prepare($inseStruct1);
            $prepStruct1->execute([$idStruct]);
            $_SESSION['modification'] = "Désactivation de la franchise réussie ! " ;
            header('Location: ./structures-page.php');
        
            
        }
} else {
    //sinon ce nes pas un admin creer un message d'erreur
    $_SESSION['error-modif-struct'] = "Vous n'avais pas acces aux changement du statut (Activer/Désactiver) d'une structure veuiller contacter l'administrateur : " ;
    header('Location: ./structures-page.php');
    
}
