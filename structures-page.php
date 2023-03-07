<?php
require_once './db.php';
session_start();

    //si la session verif existe pas personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Structures</title>
</head>
<body>
    <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 border-bottom text-bg-dark">
      <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">Tradi Fitness</span>
      </a>

      <ul class="nav nav-pills mx-5">
        <li class="nav-item"><a href="./franchises-page.php" class="nav-link " aria-current="page">Nos franchises</a></li>
        <li class="nav-item"><a href="./structures-page.php" class="nav-link active ">Nos structures</a></li>
      </ul>
    </header>
     <?php    
        //si une modification est faite affiche la dans un modal
        if (isset($_SESSION['modification'])) {
            ?>
                <div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle m-2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg>                                           
                        <?php echo $_SESSION['modification']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>                                            
                </div>    
            <?php
        }
         //si la global session error existe affiche la
        if (isset($_SESSION['error-modif-struct'])) {
            include './get-structures.php';
            ?>
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['error-modif-struct'] . $arrayAd[0]['email']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php  
                                    }
         //si la session error des permission exite affiche la
        if (isset($_SESSION['error-perm'])) {
            include './get-structures.php';
                ?>
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">                                           
                        <?php echo $_SESSION['error-permission'] . $arrayAd[0]['email']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>    
            <?php
        }
        //si une permission global est modifier affiche une alert success
        if (isset($_SESSION['changement-perm'])) {
            ?>
                <div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">                                           
                        <?php echo $_SESSION['changement-perm-glo'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>    
            <?php
        }
        
        //si une structure est créer affiche une modale d'info de validation
        if (isset($_SESSION['creationStr'])) {
            ?>
                <div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">                                           
                        <?php echo $_SESSION['creationStr'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>    
            <?php
        }
            ?>
                                    
            
    <h1 class="text-center">Nos Structures</h1> 

    <!-- inclue ma navigation (barre de recherche) -->
    <?php include_once './nav-structures.php'; ?>    

    <main>
        <?php 
            //si le bouton de consultation 
            if (isset($_POST['btnConsulter'])) {
               ?>
                <div class="container alert alert-secondary">
                    <p>
                        <h3 class="text-center"><?= $_POST['btnConsulter']?></h3>    
                    </p>
                </div>
               <?php
            }
        ?>
        <div class="container  mb-5">
                <div class="row-cols-lg-3 row-cols-sm-2 row row-cols-1 g-2 g-lg-3">
                    <?php
                //inclu mon traitement de modal qui vient creer mais carte 
                include_once './structures-modal.php';               
                ?>    
                </div>
        </div>
            <?php
        //BOUTON AJOUTER UNE STRUCTURE accessible a l'admin sinon disabled
            if ($_SESSION['id-admin']) {
                echo '<div class="container text-center mb-5">
                            <a href="./form-str-inscription.php" class="btn btn-warning">Ajouter une Structure</a>
                        </div>';
            } else {
                echo '<div class="container text-center mb-5">
                            <a href="./form-str-inscription.php" class="btn btn-warning disabled">Ajouter une Structure</a>
                        </div>';
            }
        ?>
    </main>

        <style>
             body {
            width: 100vw;
            height: 100%;         
            background-image: url("img/background2.jpg");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            color: white;
            }
            nav {  
                margin: 15px;
            }
            h1 {
                margin: 150px;
                font-family: 'Great Vibes', cursive;
                font-size: 4em;
            }
            
            main {
                color: black;
            }
            .card{
                transition:transform .4s ;
            }
            .card:hover {
                transform: scale(1.02);
            }
            img {
                border-radius: 5px;
                height: 300px;  
            }
            header span {
            color: white;
            }
           @media screen and (max-width:768px) {
            h1 {
                margin: 60px;
               font-size: 2.5rem; 
            }
            .btn {
                font-size: 0.8rem;
            }
            .nav-item {
                font-size: 0.8rem;
            }
            .input-group {
                margin-top: 5px;
            }
           }
            
        </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>