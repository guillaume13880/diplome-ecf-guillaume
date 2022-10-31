<?php
//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$database = new PDO($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


//Connexion au serveur
//define('DB_HOST', 'localhost:3306');
//define('DB_PORT', '3306');
//define('DB_DATABASE', 'ecf-graduate-2');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');


//création d'une instance de la classe PDO avec les paramètre de connexion définis
//$database = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);

//si on a une erreur renvoie une exeption
 //$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  