<?php
require_once './db.php';
include './get-franchises.php';

session_start();

    //si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}



//recup le btn vraie est faux
$active = $_POST['type'];
$sess2 =  $_SESSION['id-admin'];
$id = (int)$_POST['id-card'];
//var_dump($id);


//si ces bien l'admin de connecter
if (isset($sess2)) {
        //si le bouton est vraie
        if ($active == 'TRUE') {
            
            //modifie dans la base vraie en fonction de la session id a la connexion
            $inse = "UPDATE `franchises` SET `franchises_active`= 1 WHERE id = ?";
            $prep = $database->prepare($inse);
            $prep->execute([$id]);
            $_SESSION['modification'] = "Activation de la franchise réussie ! " ;
            header('Location: ./franchises-page.php');
            
        } else {
        
            $inse1 = "UPDATE `franchises` SET `franchises_active`= 0 WHERE id = ?";
            $prep1 = $database->prepare($inse1);
            $prep1->execute([$id]);
            $_SESSION['modification'] = "Désactivation de la franchise réussie ! " ;
            header('Location: ./franchises-page.php');
        
            
        }
} else {
    //sinon ce nes pas un admin creer un message d'erreur
    $_SESSION['error-modif'] = "Vous n'avais pas acces aux changement du statut (Activer/Désactiver) d'un partenaire veuiller contacter l'administrateur : " ;
    header('Location: ./franchises-page.php');
    
}



?>



