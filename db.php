<?php
//Get Heroku ClearDB connection information

//Connexion au serveur
//$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
//define('DB_HOST', $cleardb_url["host"]);
//define('DB_PORT', '3306');
//define('DB_DATABASE', substr($cleardb_url["path"],1));
//define('DB_USERNAME', $cleardb_url["user"]);
//define('DB_PASSWORD', $cleardb_url["pass"]);


//création d'une instance de la classe PDO avec les paramètre de connexion définis
//$database = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);

//Connexion au serveur
define('DB_HOST', 'localhost:3306');
define('DB_DATABASE', 'ecf-graduate-2');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');


//création d'une instance de la classe PDO avec les paramètre de connexion définis
$database = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);

//si on a une erreur renvoie une exeption
 $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  