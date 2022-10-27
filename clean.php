<?php

//fonction qui permet de securiser les entrers
function clean($input){
    //Convertit tous les caractères éligibles en entités HTML
    $input = htmlspecialchars($input);
    //Supprime les antislashs d'une chaîne
    $input = stripslashes($input);
    //Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
    $input = trim($input);
    return $input;
}