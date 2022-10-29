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
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body> 
    <div class="login-form">
        <?php
                //si la global session error existe affiche la
                if (isset($_SESSION['error'])) {
                    ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?php  
                        echo $_SESSION['error'];
                        ?>
                    </div>
                    <?php  
                }
                
                session_destroy();
            ?>
        <form action="./connexion-trait.php" method="POST"> 
            <h2 class="text-center">TRADI FITNESS</h2>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password" >Mot de passe</label>
                <input type="password" name="password" class="form-control" aria-describedby="passwordHelpBlock">
                <div class="form-text">
                    Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
                </div>
            </div>
            <div class="form-group text-center mt-3">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Connexion</button>
            </div> 
        </form>
    </div>
    <style>
        body {
            width: 100vw;
            height: 100%;
            background-image: url("img/img_connexion.jpg");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
        .login-form {
            width: 500px;
            margin: 200px auto;
            
        }
        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
            margin: 10px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
        }
        @media screen and (max-width: 600px) {
            .login-form {
            width: 340px;
            margin: 15vh auto;
            
        }
        }
       
    </style>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>