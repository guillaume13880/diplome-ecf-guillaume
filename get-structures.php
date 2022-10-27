<?php

//recupere dans la bdd structure complet
                $recupStruct = "SELECT * FROM `structures` WHERE 1";
                    //Prépare une requête à l'exécution et retourne un objet
                $prepareStruct = $database->prepare($recupStruct);
                    //Exécute une requête préparée
                $prepareStruct->execute();
                $arrayStruct = $prepareStruct->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($arrayStruct);

//recupere la bdd admin 
                $recupAd = "SELECT * FROM `admins` WHERE 1";
                    //Prépare une requête à l'exécution et retourne un objet
                $prepareAd = $database->prepare($recupAd);
                    //Exécute une requête préparée
                $prepareAd->execute();
                $arrayAd = $prepareAd->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($arrayAd); 