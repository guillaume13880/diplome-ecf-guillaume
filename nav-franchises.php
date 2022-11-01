<?php
//si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}
//requete qui recup les franchises et admin
include './get-franchises.php';
?>


    <nav class="container">
        <div class="row-cols-lg-2  row row-cols-1 ">
            <form method="GET">
                <div class="col d-flex">
                    <input class="form-control" type="search" name="rechercher" placeholder="Rechercher un partenaire par son nom ...." autocomplete="off">
                    <input type="submit" name="envoyer" class="btn btn-primary">
                </div>
            </form>
            <div class="col d-flex justify-content-end align-items-center sm-justify-content-center">
                <form method="POST">
                    <div class="input-group">
                        <input type="submit" class="btn btn-primary" value="Toute" name="toute">
                        <input type="submit" class="btn btn-primary" value="Active" name="active">
                        <input type="submit" class="btn btn-primary" value="Inactive" name="inactive">                       
                    </div>                                             
                </form>
            </div>
        </div>       
    </nav>
    <?php  
    
    //si l'input exite est nes pas vide (securité) dans la barre de recherche
    if (isset($_GET['rechercher']) && !empty($_GET['rechercher'])) {
        //je sécurise les entrers 
        $recherche = htmlspecialchars($_GET['rechercher']);
        //selectionne le nom des franchise est compare le avec l'input
        $allFranchises = "SELECT * FROM `franchises` WHERE `name` LIKE '%".$recherche."%'";
        $prepareAll = $database->prepare($allFranchises);
        $prepareAll->execute();
        $arrayAll = $prepareAll->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($arrayAll);

        //si un partenaire existe affiche le
        if ($arrayAll) {
            ?>
            <div class="container mb-5">
                <div class="row-cols-lg-3 row-cols-sm-2 row row-cols-1 g-2 g-lg-3">
            <?php

                foreach ($arrayAll as $items) {
                ?>
                    <div class="col">
                        <div class="card"> 
                            <img src="<?php  echo $items['images'] ?>" alt="carte image top" >
                            <div class="card-body"> 
                                <div class="card-text d-flex flex-wrap justify-content-center ">
                                    <form id="form-true" method="POST" action="./btn-activ-fran.php" class="card-text text-center mb-2">     
                                        <input type="hidden" name="id-card" id="id-card" value="<?= $items['id']?>">
                                        <label for="id-card"></label>
                                        <?php if ($items['franchises_active'] == 1) {
                                            //Si l'item est actif affiche l'input avec la couleur vert
                                            echo '<input type="submit" value="Partenaire activer" class="btn btn-success">';
                                        } else {
                                            //Sinon l'item est desactif affiche l'input sans couleur
                                            echo '<input type="submit" value="Partenaire activer" class="btn btn-outline-success">';
                                        } ?>
                                        <input type="hidden" value="TRUE" name="type">                         
                                        <label for="type"></label>
                                    </form>

                                    <form id="form-false" method="POST" action="./btn-activ-fran.php" class="card-text text-center mb-2"> 
                                        <input type="hidden" name="id-card" id="id-card" value="<?= $items['id']?>">
                                        <label for="id-card"></label>

                                        <?php if ($items['franchises_active'] == 0) {
                                            //Si l'item est actif affiche l'input avec la couleur vert
                                            echo '<input type="submit" value="Partenaire désactiver" class="btn btn-warning">';
                                        } else {
                                            //Sinon l'item est desactif affiche l'input sans couleur
                                            echo '<input type="submit" value="Partenaire désactiver" class="btn btn-outline-success">';
                                        } ?>

                                        <input type="hidden" value="FALSE" name="type">
                                        <label for="type"></label>
                                    </form>
                                </div>
                                            
                                <h5 class="card-title text-center"><?php  echo $items['name']  ?></h5>
                                            
                                <ul class="card-text">
                                                
                                    <!-- <li>La franchise <?php  //echo $items['name'] ?> est actuellement (active)</li> -->
                                    <li>Code postal : <?php  echo $items['code_postale'] ?></li>
                                    <li>Email franchise : <br><?php  echo $items['email-franchises'] ?></li>
                                    <li>Le gérant est : <?php  echo $items['name_gerant'] ?></li>
                                    <li>Email du gérant : <br><?php  echo $items['email_gerant'] ?></li>
                                                                                                            
                                </ul>
                                <p class="card-text text-center">
                                    <a href="#" class="btn btn-primary">Consulter</a>
                                </p>
                            </div>

                        
                            <div class="card-footer accordion accordion-flush d-grid" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Nos permissions globals
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <?php
                                            //var_dump($items['FK_perm_global'])
                                            //var_dump($arrayPerm[0])
                                            
                                            ?>
                                            <ul class="list-group">
                                                <form method="POST" id="form-perm-true" action="./franchises-permissions.php">
                                                    <li class="list-group-item">                                             
                                                        <input type="checkbox" name="programmer1"> Vendre des boissons <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $items['FK_perm_global']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer2"> Envoyer new <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $items['FK_perm_global']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer3"> Gérer les plannings <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $items['FK_perm_global']?>">  
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer4"> Télévision <br> 
                                                        <input type="hidden" name="id-perm-glo" value="<?= $items['FK_perm_global']?>">                                       
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer5"> Music <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $items['FK_perm_global']?>">    
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer6"> Parking sur place <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $items['FK_perm_global']?>">               
                                                    </li>
                                                
                                                    <li class="list-group-item text-center">
                                                        <input type="submit" name="btn-valid" class="btn btn-success btn-sm" value="Valider"> 
                                                    </li>
                                                </form>
                                    
                                            </ul>           
                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }              
                ?> 
                </div>
            </div>
            <style>
                body {
                    width: 100vw;
                    height: 100%;
                    background-image: url("img/background1.jpg");
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
                    margin: 100px;
                }
                
                .card {
                    color: black;
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
                    font-size: 1.2rem; 
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
        <?php 
        die();   
                
            } else {
                ?>
                <style>
                body {
                    width: 100vw;
                    height: 100%;
                    background-image: url("img/background1.jpg");
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
                    margin: 100px;
                }
                
                .card {
                    color: black;
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
                    font-size: 1.2rem; 
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
                <?php
                echo '<p class="container alert alert-danger text-center">Auncun partenaire trouver</p>';
                die();                   
            }
    }  

    //BOUTON TOUTE si le bouton de filtre Toute existe renvoie sur la page principal 
    if (isset($_POST['toute']) ) {
        header('Location: ./franchises-page.php');
    }

    //BOUTON ACTIVE si le bouton de filtre Active existe 
    if (isset($_POST['active']) ) {
        ?>
        <div class="container">
           <div class="row-cols-lg-3 row-cols-sm-2 row row-cols-1 g-2 g-lg-3">
            <?php
          foreach ($arrayNa as $itemsNa) {
              if ($itemsNa['franchises_active'] == 1) {
                  //var_dump($itemsNa);
                ?>
                    <div class="col">
                        <div class="card"> 
                            <img src="<?php  echo $itemsNa['images'] ?>" alt="carte image top" >
                            <div class="card-body"> 
                                <div class="card-text d-flex flex-wrap justify-content-center ">
                                    <form id="form-true" method="POST" action="./btn-activ-fran.php" class="card-text text-center mb-2">     
                                        <input type="hidden" name="id-card" id="id-card" value="<?= $itemsNa['id']?>">
                                        <label for="id-card"></label>
                                        <?php if ($itemsNa['franchises_active'] == 1) {
                                            //Si l'item est actif affiche l'input avec la couleur vert
                                            echo '<input type="submit" value="Partenaire activer" class="btn btn-success">';
                                        } else {
                                            //Sinon l'item est desactif affiche l'input sans couleur
                                            echo '<input type="submit" value="Partenaire activer" class="btn btn-outline-success">';
                                        } ?>
                                        <input type="hidden" value="TRUE" name="type">                         
                                        <label for="type"></label>
                                    </form>

                                    <form id="form-false" method="POST" action="./btn-activ-fran.php" class="card-text text-center mb-2"> 
                                        <input type="hidden" name="id-card" id="id-card" value="<?= $itemsNa['id']?>">
                                        <label for="id-card"></label>

                                        <?php if ($itemsNa['franchises_active'] == 0) {
                                            //Si l'item est actif affiche l'input avec la couleur vert
                                            echo '<input type="submit" value="Partenaire désactiver" class="btn btn-success">';
                                        } else {
                                            //Sinon l'item est desactif affiche l'input sans couleur
                                            echo '<input type="submit" value="Partenaire désactiver" class="btn btn-outline-success">';
                                        } ?>

                                        <input type="hidden" value="FALSE" name="type">
                                        <label for="type"></label>
                                    </form>
                                </div>
                                            
                                <h5 class="card-title text-center"><?php  echo $itemsNa['name']  ?></h5>
                                            
                                <ul class="card-text">
                                                
                                    <!-- <li>La franchise <?php  //echo $items['name'] ?> est actuellement (active)</li> -->
                                    <li>Code postal : <?php  echo $itemsNa['code_postale'] ?></li>
                                    <li>Email franchise : <br><?php  echo $itemsNa['email-franchises'] ?></li>
                                    <li>Le gérant est : <?php  echo $itemsNa['name_gerant'] ?></li>
                                    <li>Email du gérant : <br><?php  echo $itemsNa['email_gerant'] ?></li>
                                                                                                            
                                </ul>
                                <p class="card-text text-center">
                                    <a href="#" class="btn btn-primary">Consulter</a>
                                </p>
                            </div>

                        
                            <div class="card-footer accordion accordion-flush d-grid" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Nos permissions globals
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <?php
                                            //var_dump($items['FK_perm_global'])
                                            //var_dump($arrayPerm[0])
                                            
                                            ?>
                                            <ul class="list-group">
                                                <form method="POST" id="form-perm-true" action="./franchises-permissions.php">
                                                    <li class="list-group-item">                                             
                                                        <input type="checkbox" name="programmer1"> Vendre des boissons <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer2"> Envoyer new <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer3"> Gérer les plannings <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">  
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer4"> Télévision <br> 
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">                                       
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer5"> Music <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">    
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer6"> Parking sur place <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">               
                                                    </li>
                                                
                                                    <li class="list-group-item text-center">
                                                        <input type="submit" name="btn-valid" class="btn btn-success btn-sm" value="Valider"> 
                                                    </li>
                                                </form>
                                    
                                            </ul>           
                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
            }
            ?>
            </div> 
         </div>
         <style>
                body {
                    width: 100vw;
                    height: 100%;
                    background-image: url("img/background1.jpg");
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
                    margin: 100px;
                }
                .container {
                    margin-bottom: 15px;
                }
                
                .card {
                    color: black;
                
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
                    font-size: 1.2rem; 
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
         <?php
         die();
                               
    }

    //BOUTON INACTIVE si le bouton de filtre Inactive existe 
    if (isset($_POST['inactive']) ) {
        ?>
        <div class="container">
           <div class="row-cols-lg-3 row-cols-sm-2 row row-cols-1 g-2 g-lg-3">
            <?php
          foreach ($arrayNa as $itemsNa) {
              if ($itemsNa['franchises_active'] == 0) {
                  //var_dump($itemsNa);
                ?>
                    <div class="col">
                        <div class="card"> 
                            <img src="<?php  echo $itemsNa['images'] ?>" alt="carte image top" >
                            <div class="card-body"> 
                                <div class="card-text d-flex flex-wrap justify-content-center ">
                                    <form id="form-true" method="POST" action="./btn-activ-fran.php" class="card-text text-center mb-2">     
                                        <input type="hidden" name="id-card" id="id-card" value="<?= $itemsNa['id']?>">
                                        <label for="id-card"></label>
                                        <?php if ($itemsNa['franchises_active'] == 1) {
                                            //Si l'item est actif affiche l'input avec la couleur vert
                                            echo '<input type="submit" value="Partenaire activer" class="btn btn-success">';
                                        } else {
                                            //Sinon l'item est desactif affiche l'input sans couleur
                                            echo '<input type="submit" value="Partenaire activer" class="btn btn-outline-success">';
                                        } ?>
                                        <input type="hidden" value="TRUE" name="type">                         
                                        <label for="type"></label>
                                    </form>

                                    <form id="form-false" method="POST" action="./btn-activ-fran.php" class="card-text text-center mb-2"> 
                                        <input type="hidden" name="id-card" id="id-card" value="<?= $itemsNa['id']?>">
                                        <label for="id-card"></label>

                                        <?php if ($itemsNa['franchises_active'] == 0) {
                                            //Si l'item est actif affiche l'input avec la couleur vert
                                            echo '<input type="submit" value="Partenaire désactiver" class="btn btn-warning">';
                                        } else {
                                            //Sinon l'item est desactif affiche l'input sans couleur
                                            echo '<input type="submit" value="Partenaire désactiver" class="btn btn-outline-success">';
                                        } ?>

                                        <input type="hidden" value="FALSE" name="type">
                                        <label for="type"></label>
                                    </form>
                                </div>
                                            
                                <h5 class="card-title text-center"><?php  echo $itemsNa['name']  ?></h5>
                                            
                                <ul class="card-text">
                                                
                                    <!-- <li>La franchise <?php  //echo $items['name'] ?> est actuellement (active)</li> -->
                                    <li>Code postal : <?php  echo $itemsNa['code_postale'] ?></li>
                                    <li>Email franchise : <br><?php  echo $itemsNa['email-franchises'] ?></li>
                                    <li>Le gérant est : <?php  echo $itemsNa['name_gerant'] ?></li>
                                    <li>Email du gérant : <br><?php  echo $itemsNa['email_gerant'] ?></li>
                                                                                                            
                                </ul>
                                <p class="card-text text-center">
                                    <a href="#" class="btn btn-primary">Consulter</a>
                                </p>
                            </div>

                        
                            <div class="card-footer accordion accordion-flush d-grid" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Nos permissions globals
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <?php
                                            //var_dump($items['FK_perm_global'])
                                            //var_dump($arrayPerm[0])
                                            
                                            ?>
                                            <ul class="list-group">
                                                <form method="POST" id="form-perm-true" action="./franchises-permissions.php">
                                                    <li class="list-group-item">                                             
                                                        <input type="checkbox" name="programmer1"> Vendre des boissons <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer2"> Envoyer new <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer3"> Gérer les plannings <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">  
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer4"> Télévision <br> 
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">                                       
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer5"> Music <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">    
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programmer6"> Parking sur place <br>
                                                        <input type="hidden" name="id-perm-glo" value="<?= $itemsNa['FK_perm_global']?>">               
                                                    </li>
                                                
                                                    <li class="list-group-item text-center">
                                                        <input type="submit" name="btn-valid" class="btn btn-success btn-sm" value="Valider"> 
                                                    </li>
                                                </form>
                                    
                                            </ul>           
                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
            }
            ?>
            </div> 
         </div>
         <style>
                body {
                    width: 100vw;
                    height: 100%;
                    background-image: url("img/background1.jpg");
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
                    margin: 100px;
                }
                .container {
                    margin-bottom: 15px;
                }
                
                .card {
                    color: black;
                   
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
                    font-size: 1.2rem; 
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
         <?php
         die();
                               
    }
    
    ?>
   