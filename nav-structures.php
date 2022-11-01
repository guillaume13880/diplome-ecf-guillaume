<?php
//si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}
//requete qui recup les franchises et admin
include './get-structures.php';
?>

<nav class="container">
    <div class="row-cols-lg-2  row row-cols-1 ">
        <form method="GET">
            <div class="col d-flex">
                <input class="form-control" type="search" name="rechercherStr" placeholder="Rechercher une structure par son nom ...." autocomplete="off">
                <input type="submit" name="envoyer" class="btn btn-primary">
            </div>
        </form>
            <div class="col d-flex justify-content-end align-items-center">
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

//si l'input exite est nes pas vide (securité)
    if (isset($_GET['rechercherStr']) && !empty($_GET['rechercherStr'])) {
        //je sécurise les entrers 
        $recherche = htmlspecialchars($_GET['rechercherStr']);
        $allFranchises = "SELECT * FROM `structures` WHERE `name` LIKE '%".$recherche."%'";
        $prepareAll = $database->prepare($allFranchises);
        $prepareAll->execute();
        $arrayStr = $prepareAll->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($arrayAll);

        //si un partenaire existe affiche le
        if ($arrayStr) {
            ?>
            <div class="container mb-5">
                <div class="row-cols-lg-3 row-cols-sm-2 row row-cols-1 g-2 g-lg-3">
            <?php

            foreach ($arrayStr as $keys) {
            ?>
                    <div class="col">
                        <div class="card"> 
                            <img src="<?php  echo $keys['images'] ?>" alt="carte image top" >
                            <div class="card-body"> 
                                <div class="card-text d-flex flex-wrap justify-content-center ">
                                    <form id="form-true" method="POST" action="./btn-activ-struct.php" class="card-text text-center mb-2">     
                                        <input type="hidden" name="id-card-struct" id="id-card-struct" value="<?= $keys['id'] ?>">
                                        <label for="id-card-struct"></label>
                                        <?php if ($keys['structure_active'] == 1) {
                                                //Si l'item est actif affiche l'input avec la couleur vert
                                                echo '<input type="submit" value="Partenaire activer" class="btn btn-success">';
                                                } else {
                                                    //Sinon l'item est desactif affiche l'input sans couleur
                                                    echo '<input type="submit" value="Partenaire activer" class="btn btn-outline-success">';
                                                } ?>
                                        <input type="hidden" value="TRUE" name="type1">                         
                                        <label for="type1"></label>
                                    </form>

                                    <form id="form-false" method="POST" action="./btn-activ-struct.php" class="card-text text-center mb-2"> 
                                        <input type="hidden" name="id-card-struct" id="id-card-struct" value="<?= $keys['id'] ?>">
                                        <label for="id-card-struct"></label>
                                        <?php if ($keys['structure_active'] == 0) {
                                                //Si l'item est actif affiche l'input avec la couleur vert
                                                echo '<input type="submit" value="Partenaire désactiver" class="btn btn-warning">';
                                                } else {
                                                    //Sinon l'item est desactif affiche l'input sans couleur
                                                    echo '<input type="submit" value="Partenaire désactiver" class="btn btn-outline-success">';
                                                } ?>
                                        <input type="hidden" value="FALSE" name="type1">
                                        <label for="type1"></label>
                                    </form>
                                </div>

                                <h5 class="card-title text-center"><?php  echo $keys['name']  ?></h5>
                                
                                <ul class="card-text">
                                    <li>Email structure : <?php  echo $keys['email_structures'] ?></li>
                                    <li>Address : <?php  echo $keys['address'] ?></li>
                                    <li>Fais partie des franchises : <?php  echo $keys['FK_franchise'] ?></li>
                                    <li>Le gérant est : <?php  echo $keys['name_gerant'] ?></li>
                                    <li>Email du gérant : <?php  echo $keys['email_gerant'] ?></li>
                                                                                                 
                                </ul>
                            </div>
                            <div class="card-footer accordion accordion-flush d-grid" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Nos permissions
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <?php
                                            //var_dump($items['FK_perm_global'])
                                            //var_dump($arrayPerm[0])
                                            
                                            ?>
                                            <ul class="list-group">
                                                <form method="POST" id="form-perm-true" action="./structures-permissions.php">
                                                    <li class="list-group-item">                                             
                                                        <input type="checkbox" name="programme1"> Vendre des boissons <br>
                                                        <input type="hidden" name="id-perm" value="<?= $keys['FK_module']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme2"> Envoyer new <br>
                                                        <input type="hidden" name="id-perm" value="<?= $keys['FK_module']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme3"> Gérer les plannings <br>
                                                        <input type="hidden" name="id-perm" value="<?= $keys['FK_module']?>">  
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme4"> Télévision <br> 
                                                        <input type="hidden" name="id-perm" value="<?= $keys['FK_module']?>">                                       
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme5"> Music <br>
                                                        <input type="hidden" name="id-perm" value="<?= $keys['FK_module']?>">    
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme6"> Parking sur place <br>
                                                        <input type="hidden" name="id-perm" value="<?= $keys['FK_module']?>">               
                                                    </li>
                                                
                                                    <li class="list-group-item text-center">
                                                        <input type="submit" name="btn-valid-perm" class="btn btn-success btn-sm" value="Valider"> 
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
                echo '<p class="container alert alert-danger text-center">Auncune structure trouver</p>';
                die();                   
            }
    }  

    //BOUTON TOUTE si le bouton de filtre Toute existe renvoie sur la page principal 
    if (isset($_POST['toute']) ) {
        header('Location: ./structures-page.php');
    }

    //BOUTON ACTIVE si le bouton de filtre Active existe 
    if (isset($_POST['active']) ) {
        ?>
        <div class="container">
            <div class="row-cols-lg-3 row-cols-sm-2 row row-cols-1 g-2 g-lg-3">
                <?php 
                foreach ($arrayStruct as $itemSt) {
                    if ($itemSt['structure_active'] == 1) {
                        ?>
                        <div class="col">
                            <div class="card"> 
                                <img src="<?php  echo $itemSt['images'] ?>" alt="carte image top" >
                                <div class="card-body"> 
                                    <div class="card-text d-flex flex-wrap justify-content-center ">
                                        <form id="form-true" method="POST" action="./btn-activ-struct.php" class="card-text text-center mb-2">     
                                            <input type="hidden" name="id-card-struct" id="id-card-struct" value="<?= $itemSt['id'] ?>">
                                            <label for="id-card-struct"></label>
                                            <?php if ($itemSt['structure_active'] == 1) {
                                                    //Si l'item est actif affiche l'input avec la couleur vert
                                                    echo '<input type="submit" value="Partenaire activer" class="btn btn-success">';
                                                    } else {
                                                        //Sinon l'item est desactif affiche l'input sans couleur
                                                        echo '<input type="submit" value="Partenaire activer" class="btn btn-outline-success">';
                                                    } ?>
                                            <input type="hidden" value="TRUE" name="type1">                         
                                            <label for="type1"></label>
                                        </form>

                                        <form id="form-false" method="POST" action="./btn-activ-struct.php" class="card-text text-center mb-2"> 
                                            <input type="hidden" name="id-card-struct" id="id-card-struct" value="<?= $itemSt['id'] ?>">
                                            <label for="id-card-struct"></label>
                                            <?php if ($itemSt['structure_active'] == 0) {
                                                    //Si l'item est actif affiche l'input avec la couleur vert
                                                    echo '<input type="submit" value="Partenaire désactiver" class="btn btn-success">';
                                                    } else {
                                                        //Sinon l'item est desactif affiche l'input sans couleur
                                                        echo '<input type="submit" value="Partenaire désactiver" class="btn btn-outline-success">';
                                                    } ?>
                                            <input type="hidden" value="FALSE" name="type1">
                                            <label for="type1"></label>
                                        </form>
                                    </div>

                                    <h5 class="card-title text-center"><?php  echo $itemSt['name']  ?></h5>
                                    
                                    <ul class="card-text">
                                        <li>Email structure : <?php  echo $itemSt['email_structures'] ?></li>
                                        <li>Address : <?php  echo $itemSt['address'] ?></li>
                                        <li>Fais partie des franchises : <?php  echo $itemSt['FK_franchise'] ?></li>
                                        <li>Le gérant est : <?php  echo $itemSt['name_gerant'] ?></li>
                                        <li>Email du gérant : <?php  echo $itemSt['email_gerant'] ?></li>
                                                                                                    
                                    </ul>
                                </div>
                                <div class="card-footer accordion accordion-flush d-grid" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Nos permissions
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?php
                                                //var_dump($items['FK_perm_global'])
                                                //var_dump($arrayPerm[0])
                                                
                                                ?>
                                                <ul class="list-group">
                                                    <form method="POST" id="form-perm-true" action="./structures-permissions.php">
                                                        <li class="list-group-item">                                             
                                                            <input type="checkbox" name="programme1"> Vendre des boissons <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">
                                                        </li> 

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme2"> Envoyer new <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">
                                                        </li> 

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme3"> Gérer les plannings <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">  
                                                        </li>

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme4"> Télévision <br> 
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">                                       
                                                        </li>

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme5"> Music <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">    
                                                        </li>

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme6"> Parking sur place <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">               
                                                        </li>
                                                    
                                                        <li class="list-group-item text-center">
                                                            <input type="submit" name="btn-valid-perm" class="btn btn-success btn-sm" value="Valider"> 
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
                foreach ($arrayStruct as $itemSt) {
                    if ($itemSt['structure_active'] == 0) {
                        ?>
                        <div class="col">
                            <div class="card"> 
                                <img src="<?php  echo $itemSt['images'] ?>" alt="carte image top" >
                                <div class="card-body"> 
                                    <div class="card-text d-flex flex-wrap justify-content-center ">
                                        <form id="form-true" method="POST" action="./btn-activ-struct.php" class="card-text text-center mb-2">     
                                            <input type="hidden" name="id-card-struct" id="id-card-struct" value="<?= $itemSt['id'] ?>">
                                            <label for="id-card-struct"></label>
                                            <?php if ($itemSt['structure_active'] == 1) {
                                                    //Si l'item est actif affiche l'input avec la couleur vert
                                                    echo '<input type="submit" value="Partenaire activer" class="btn btn-success">';
                                                    } else {
                                                        //Sinon l'item est desactif affiche l'input sans couleur
                                                        echo '<input type="submit" value="Partenaire activer" class="btn btn-outline-success">';
                                                    } ?>
                                            <input type="hidden" value="TRUE" name="type1">                         
                                            <label for="type1"></label>
                                        </form>

                                        <form id="form-false" method="POST" action="./btn-activ-struct.php" class="card-text text-center mb-2"> 
                                            <input type="hidden" name="id-card-struct" id="id-card-struct" value="<?= $itemSt['id'] ?>">
                                            <label for="id-card-struct"></label>
                                            <?php if ($itemSt['structure_active'] == 0) {
                                                    //Si l'item est actif affiche l'input avec la couleur vert
                                                    echo '<input type="submit" value="Partenaire désactiver" class="btn btn-warning">';
                                                    } else {
                                                        //Sinon l'item est desactif affiche l'input sans couleur
                                                        echo '<input type="submit" value="Partenaire désactiver" class="btn btn-outline-success">';
                                                    } ?>
                                            <input type="hidden" value="FALSE" name="type1">
                                            <label for="type1"></label>
                                        </form>
                                    </div>

                                    <h5 class="card-title text-center"><?php  echo $itemSt['name']  ?></h5>
                                    
                                    <ul class="card-text">
                                        <li>Email structure : <?php  echo $itemSt['email_structures'] ?></li>
                                        <li>Address : <?php  echo $itemSt['address'] ?></li>
                                        <li>Fais partie des franchises : <?php  echo $itemSt['FK_franchise'] ?></li>
                                        <li>Le gérant est : <?php  echo $itemSt['name_gerant'] ?></li>
                                        <li>Email du gérant : <?php  echo $itemSt['email_gerant'] ?></li>
                                                                                                    
                                    </ul>
                                </div>
                                <div class="card-footer accordion accordion-flush d-grid" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Nos permissions
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?php
                                                //var_dump($items['FK_perm_global'])
                                                //var_dump($arrayPerm[0])
                                                
                                                ?>
                                                <ul class="list-group">
                                                    <form method="POST" id="form-perm-true" action="./structures-permissions.php">
                                                        <li class="list-group-item">                                             
                                                            <input type="checkbox" name="programme1"> Vendre des boissons <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">
                                                        </li> 

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme2"> Envoyer new <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">
                                                        </li> 

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme3"> Gérer les plannings <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">  
                                                        </li>

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme4"> Télévision <br> 
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">                                       
                                                        </li>

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme5"> Music <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">    
                                                        </li>

                                                        <li class="list-group-item">
                                                            <input type="checkbox" name="programme6"> Parking sur place <br>
                                                            <input type="hidden" name="id-perm" value="<?= $itemSt['FK_module']?>">               
                                                        </li>
                                                    
                                                        <li class="list-group-item text-center">
                                                            <input type="submit" name="btn-valid-perm" class="btn btn-success btn-sm" value="Valider"> 
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