<?php
require './db.php';
include './clean.php';


session_start();

    //j'apelle ma fonction clean
$email = clean($_POST['email']);
$password = clean($_POST['password']);




     //recupere dans la table franchises les emails renseigner
$requete = "SELECT * FROM `franchises` WHERE email_gerant = ?";
    //Prépare une requête à l'exécution et retourne un objet
$prepare = $database->prepare($requete);
    //Exécute une requête préparée
$prepare->execute(array($email));
$array = $prepare->fetchAll(PDO::FETCH_ASSOC);
//var_dump($array[0]["email"]);


     //recupere dans la table franchises les emails renseigner
$requete1 = "SELECT * FROM `structures` WHERE email_gerant = ?";
    //Prépare une requête à l'exécution et retourne un objet
$prepare1 = $database->prepare($requete1);
    //Exécute une requête préparée
$prepare1->execute(array($email));
$array1 = $prepare1->fetchAll(PDO::FETCH_ASSOC);
//var_dump($array1[0]["email"]);


     //recupere dans la table franchises les emails renseigner
$requete2 = "SELECT * FROM `admins` WHERE email = ?";
    //Prépare une requête à l'exécution et retourne un objet
$prepare2 = $database->prepare($requete2);
    //Exécute une requête préparée
$prepare2->execute(array($email));
$array2 = $prepare2->fetchAll(PDO::FETCH_ASSOC);
//var_dump($array2[0]["email"]);





    //SI email existe est nes pas vide  et nes pas nul 
if (isset($email) && !empty($email))  { 
        //Si input email est === a l'email en bdd 
        if ($email == $array[0]["email_gerant"] || $email == $array1[0]['email_gerant'] || $email == $array2[0]['email']) {
            
            //Si password nes pas vide est nes pas nul
            if (isset($password) && !empty($password)) {
                
                //Si l'entrer du password est === a password en bdd
                if (password_verify($password, $array[0]["password_gerant"]) || password_verify($password, $array1[0]["password_gerant"]) || password_verify($password, $array2[0]['password'])) {   
                    $_SESSION['verif'] = $array[0]['email_gerant'] || $array1[0]['email_gerant'] || $array2[0]['email'];
                    //cree une session avec l'id de            
                    
                    $_SESSION['id-admin'] = $array2[0]['id'];
                    //redirige vers la page franchises
                    header('Location: ./franchises-page.php');

                      
                } else {
                    $_SESSION['error'] = "Mot de passe incorrect";
                    header('Location: ./index.php');                       
                }
            } else {
                header('Location: ./index.php');
            }
        } else {
            //var_dump($_SESSION);
            $_SESSION['error'] = "Email incorrect";
            header('Location: ./index.php');

        }
    } else {
        
        header('Location: ./index.php');
     
    }




 
    

    
//creation d'un admin avec un mdp securisé
    //fonction pour hasher le mdp
        // $hash1 = password_hash($password, PASSWORD_DEFAULT);
        // $requete = "INSERT INTO admins (`email`, `password`) VALUES ('$email', '$hash1')";
        // $prepare = $database->prepare($requete);
        // $prepare->execute();
        // $array = $prepare->fetchAll(PDO::FETCH_ASSOC);
        

//creation des franchises avec un mdp securisé
    //fonction pour hasher le mdp
        // $hash1 = password_hash($password, PASSWORD_DEFAULT);
        // $requete = "INSERT INTO `franchises`(`id`, `images`, `name`, `email-franchises`, `code_postale`, `franchises_active`, `name_gerant`, `email_gerant`, `password_gerant`, `FK_admin`, `FK_perm_global`) VALUES ('','','Tradi Fitness Aix en provence','tradi-fitness-aix@gmail.com','13098',TRUE,'John Doe', '$email', '$hash1','1','1')";
        
        // $prepare = $database->prepare($requete);
        // $prepare->execute();
        // $array = $prepare->fetchAll(PDO::FETCH_ASSOC);


//creation des structures avec un mdp securisé
    //fonction pour hasher le mdp
        // $hash1 = password_hash($password, PASSWORD_DEFAULT);
        // $requete = "INSERT INTO `structures`(`id`, `images`, `name`, `email_structures`, `address`, `structure_active`, `name_gerant`, `email_gerant`, `password_gerant`, `FK_franchise`, `FK_module`) VALUES ('','','Tradi Fitness vitrox','tradi-fitness-vitrox@gmail.com','31 avenue romaniquette',TRUE,'Rick doe','$email','$hash1','2','2')";
        
        // $prepare = $database->prepare($requete);
        // $prepare->execute();
        // $array = $prepare->fetchAll(PDO::FETCH_ASSOC);