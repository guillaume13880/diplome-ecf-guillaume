<?php
require_once './db.php';

session_start();

    //si la session verif existe pas, personne ne peut accéder a ctte page
if (!isset($_SESSION['verif'])) {
    header('Location: ./index.php');
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Inscription structure</title>
</head>
<body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom text-bg-dark">
      <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">Tradi Fitness</span>
      </a>

      <ul class="nav nav-pills mx-5">
        <li class="nav-item"><a href="./franchises-page.php" class="nav-link active" aria-current="page">Nos franchises</a></li>
        <li class="nav-item"><a href="./structures-page.php" class="nav-link">Nos structures</a></li>
      </ul>
    </header>
    <div class="login-form">
        <form action="./form-str-inscription-trait.php" method="POST"> 
            <h2 class="text-center">Inscription Structure</h2>
            <?php 
                if (isset($_SESSION['error-str'])) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php echo $_SESSION['error-str'] ?>
                        </div>
                    <?php
                    
                }
            ?>
            <div class="form-group">
                <label for="image-fr">Ajouter une image</label>
                <input type="text" name="image-str" class="form-control" placeholder="./img/......jpg" required="required" autocomplete="off">  
            </div>
            <div class="form-group">
                <label for="name-fr">Nom de la structure</label>
                <input type="text" name="name-str" class="form-control" placeholder="Tradi Fitness des goudes" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email-fr">Email de la structure</label>
                <input type="email" name="email-str" class="form-control" placeholder="tradi-fitness-des-goudes@gmail.com" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" placeholder="116 avenue des exemples" required="required" autocomplete="off">
            </div>
             <div class="form-group">
                <label for="structure-active">Activer la structure ?</label>
                <input type="boolean" name="structure-active" class="form-control" placeholder="(Oui/1) ou (Non/0)" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="name-gerant">Nom du gérant</label>
                <input type="text" name="name-gerant" class="form-control" placeholder="David DOE" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email-gerant">Email du gérant</label>
                <input type="email" name="email-gerant" class="form-control" placeholder="david-doe@gmail.com" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password" >Mot de passe gérant</label>
                <input type="password" name="password" class="form-control" placeholder="********" aria-describedby="passwordHelpBlock">
                <div class="form-text">
                    Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
                </div>
            </div>
            <div class="form-group">
                <label for="choix-admin">Sélectionner votre franchise associé</label>
                <input type="int" name="choix-franchise" class="form-control" placeholder="..." required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="choix-perm">Sélectionner vos permissions</label>
                <input type="int" name="choix-perm" class="form-control" placeholder="..." required="required" autocomplete="off">
            </div>
            <div class="form-group text-center mt-3">
                <button type="submit" name="submit" class="btn btn-success btn-block">Ajouter</button>
            </div> 
        </form>
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
        }
         header span {
            color: white;
        }
        .login-form {
            width: 500px;
            margin: 100px auto;
            
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
             h1 {
               font-size: 1.2rem; 
            }
            .btn {
                font-size: 0.8rem;
            }
            .nav-item {
                font-size: 0.8rem;
            }
        }    
    </style>      
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>