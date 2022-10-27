<?php

    //si la session verif existe pas personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}

//inclue la requete qui recupere la table structure complet
include './get-structures.php';




//boucle sur la requete
foreach ($arrayStruct as $key) {
    ?>
                    <div class="col">
                        <div class="card"> 
                            <img src="<?php  echo $key['images'] ?>" alt="carte image top" >
                            <div class="card-body"> 
                                <div class="card-text d-flex flex-wrap justify-content-center ">
                                    <form id="form-true" method="POST" action="./btn-activ-struct.php" class="card-text text-center mb-2">     
                                        <input type="hidden" name="id-card-struct" id="id-card-struct" value="<?= $key['id'] ?>">
                                        <label for="id-card-struct"></label>
                                        <?php if ($key['structure_active'] == 1) {
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
                                        <input type="hidden" name="id-card-struct" id="id-card-struct" value="<?= $key['id'] ?>">
                                        <label for="id-card-struct"></label>
                                        <?php if ($key['structure_active'] == 0) {
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

                                <h5 class="card-title text-center"><?php  echo $key['name']  ?></h5>
                                
                                <ul class="card-text">
                                    <li>Fais partie du groupe n°  <?php  echo $key['FK_franchise'] ?></li>
                                    <li>Address : <?php  echo $key['address'] ?></li>
                                    <li>Email structure : <?php  echo $key['email_structures'] ?></li>
                                    <li>Le gérant est : <?php  echo $key['name_gerant'] ?></li>
                                    <li>Email du gérant : <?php  echo $key['email_gerant'] ?></li>
                                                                                                 
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
                                                        <input type="hidden" name="id-perm" value="<?= $key['FK_module']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme2"> Envoyer new <br>
                                                        <input type="hidden" name="id-perm" value="<?= $key['FK_module']?>">
                                                    </li> 

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme3"> Gérer les plannings <br>
                                                        <input type="hidden" name="id-perm" value="<?= $key['FK_module']?>">  
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme4"> Télévision <br> 
                                                        <input type="hidden" name="id-perm" value="<?= $key['FK_module']?>">                                       
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme5"> Music <br>
                                                        <input type="hidden" name="id-perm" value="<?= $key['FK_module']?>">    
                                                    </li>

                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="programme6"> Parking sur place <br>
                                                        <input type="hidden" name="id-perm" value="<?= $key['FK_module']?>">               
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
