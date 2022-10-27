<?php

//recupere la bdd franchises complet
                $recupNa = "SELECT * FROM `franchises` WHERE 1";
                    //Prépare une requête à l'exécution et retourne un objet
                $prepareNa = $database->prepare($recupNa);
                    //Exécute une requête préparée
                $prepareNa->execute();
                $arrayNa = $prepareNa->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($arrayNa);

//recupere le statut actif /inactif des franchises
                $recupStatut = "SELECT `franchises_active` FROM `franchises`";
                    //Prépare une requête à l'exécution et retourne un objet
                $prepareStatut = $database->prepare($recupStatut);
                    //Exécute une requête préparée
                $prepareStatut->execute();
                $arrayStatut = $prepareStatut->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($arrayStatut);                

//recupere dans la bdd franchises tous les name
                $recupName = "SELECT `name` FROM `franchises`";
                    //Prépare une requête à l'exécution et retourne un objet
                $prepareName = $database->prepare($recupName);
                    //Exécute une requête préparée
                $prepareName->execute();
                $arrayName = $prepareName->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($arrayName);

//recupere la bdd admin 
                $recupAd = "SELECT * FROM `admins` WHERE 1";
                    //Prépare une requête à l'exécution et retourne un objet
                $prepareAd = $database->prepare($recupAd);
                    //Exécute une requête préparée
                $prepareAd->execute();
                $arrayAd = $prepareAd->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($arrayAd);
  
//recupere la bdd perm_global 
                $recupPerm = "SELECT * FROM `perm_global` WHERE 1";
                    //Prépare une requête à l'exécution et retourne un objet
                $preparePerm = $database->prepare($recupPerm);
                    //Exécute une requête préparée
                $preparePerm->execute();
                $arrayPerm = $preparePerm->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($arrayPerm);

                