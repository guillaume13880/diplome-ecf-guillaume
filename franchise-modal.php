<?php

//si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}

//inclue la requete qui recupere la table structure complet
include './get-franchises.php';  


    foreach ($arrayNa as $items) {
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
                                    
                        <li>Groupe n° <?php  echo $items['id'] ?></li>
                        <li>Code postal : <?php  echo $items['code_postale'] ?></li>
                        <li>Email franchise : <br><?php  echo $items['email-franchises'] ?></li>
                        <li>Le gérant est : <?php  echo $items['name_gerant'] ?></li>
                        <li>Email du gérant : <br><?php  echo $items['email_gerant'] ?></li>
                                                                                                 
                    </ul>
                    <div class="card-text d-flex flex-wrap justify-content-center ">
                        <form class="text-center me-2" action="./structures-page.php" method="POST" >
                            <input type="submit" name="btnConsulter" class="btn btn-primary" value="Consulter le groupe n°<?= $items['FK_perm_global']?>">
                        </form>
                        <form  action="./deleteFr.php" method="POST">
                            <input type="submit" name="btnDelete" class="btn btn-danger" value="Supprimer">
                            <input type="hidden" name="id-card-sup" value="<?= $items['FK_perm_global']?>">
                        </form> 
                    </div>
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
                                             <?php
                                             //var_dump($items['FK_perm_global']['vendre_des_boissons']);
                                                //var_dump($items['FK_perm_global']);
                                                //foreach ($arrayPerm as $permG) {
                                                    //var_dump($permG['vendre_des_boissons']);
                                                    //$arrayPerm[0]['vendre_des_boissons'] == 1
                                                    if ($items['FK_perm_global']['vendre_des_boissons'] == 1) {
                                                        ?>
                                                            <input type="checkbox" name="programmer1" checked> Vendre des boissons <br>
                                                            <input type="hidden" name="id-perm-glo" value="<?= $items['FK_perm_global']?>">
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <input type="checkbox" name="programmer1"> Vendre des boissons <br>
                                                            <input type="hidden" name="id-perm-glo" value="<?= $items['FK_perm_global']?>">
                                                        <?php
                                                    }
                                                //}
                                             ?>
                                        </li> 

                                        <li class="list-group-item">
                                            <input type="checkbox" name="programmer2" > Envoyer new <br>
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
