<?php
// cette page est accessible uniquement aux users connectés avec le role "ADMIN"
require_once(__DIR__ . '/../db/pdo.php');
require_once(__DIR__ . '/../db/PDOConnexion.php');
require_once(__DIR__ . '/../dao/UserDAO.php');
require_once(__DIR__ . '/../dao/RoleDAO.php');
require_once(__DIR__ . '/../model/Role.php');
require_once(__DIR__ . '/../model/User.php');
require_once(__DIR__ . '/../inc/functions.inc.php');
include_once(__DIR__ . '/../test/testCsrfToken.php');

session_start();

// Controle d'accès

if (loggedUserRole() != 'Admin') {
    header("location: ../index.php?auth=false");
    exit;
    //var_dump($role);
}

// var_dump($_SESSION);
$errors = isset($_SESSION["errors"]) ?
    $_SESSION["errors"] : [];
$user = isset($_SESSION["user"]) ?
    $_SESSION["user"] : null;

$email = "";
$nom = "";
$prenom = "";
$dob = 0;
$genre = "";
$taille = 0;
$password = "";

if ($user != null) {
    $email = $user->getEmail();
    $nom = $user->getNom();
    $prenom = $user->getPrenom();
    $dob = $user->getDob();
    $genre = $user->getGenre();
    $taille = $user->getTaille();
    $password = $user->getPassword();
}
unset($_SESSION["errors"]);
unset($_SESSION["user"]);
// var_dump($user);
//var_dump($errors);


$roleDao = new RoleDAO($connexion);
$roles = $roleDao->getRoles();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <h1>Ajouter un Utilisateur</h1>
    <form action="../control/ajoutUserAction.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?= $email; ?>"><br>
            <?php if (array_key_exists("email", $errors)) : ?>
                <span class="bg-danger">Email Invalide</span><br>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?= $nom; ?>"><br>
            <?php if (array_key_exists("nom", $errors)) : ?>
                <span class="bg-danger">Nom Invalide</span><br>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="prenom">Prenom :</label>
            <input type="text" name="prenom" id="prenom" value="<?= $prenom; ?>"><br>
            <?php if (array_key_exists("prenom", $errors)) : ?>
                <span class="bg-danger">Prenom Invalide</span><br>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="dob">Date de naissance :</label>
            <input type="date" name="dob" id="dob" value="<?= $dob; ?>"><br>
            <?php if (array_key_exists("dateNaissance", $errors)) : ?>
                <span class="bg-danger">Date de naissance Invalide</span><br>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="genre">Genre :</label>
            <select name="genre" id="genre" required>
                <option value="F" selected>Femme</option>
                <option value="M">Homme</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="taille">Taille (en cm) :</label>
            <input type="number" name="taille" id="taille" min="100" max="250" value="<?= $taille; ?>"><br>
            <?php if (array_key_exists("taille", $errors)) : ?>
                <span class="bg-danger">Taille Invalide</span><br>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password">Password :</label>
            <input type="password" name="password" id="password" value="<?= $password; ?>"><br>
            <?php if (array_key_exists("password", $errors)) : ?>
                <span class="bg-danger">Password Invalide</span><br>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="role">Role :</label>
            <select name="role" id="role" required>
                <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role->getId() ?>"><?= $role->getNom() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="imageFile">Photo De Profil :</label>
            <input type="file" name="imageFile" id="imageFile">
        </div>
        <div><!-- Ajouter le jeton CSRF dans le formulaire et vérifier si le jeton est déja présent dans la session avec la fonction crée "csrfToken" -->
            <input type="hidden" name="_csrf_token" value="<?=csrfToken() ?>">
            <input type="submit" value="Envoyer">

        </div>


    </form>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        $(function() {
            // alert("js")
            // let emailElement = $("#email")
            $("#email").on("blur", function(event) {
                let email = $("#email").val();
                console.log(email);
                $.ajax({
                    url: "http://localhost/module7/projetfilrougeV3/control/verif_mail.php",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        email: email
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.res) {
                            alert("Email n'est pas disponible !")
                            $("#email").css('border', "2px solid red");
                        } else {
                            $("#email").css('border', "2px solid green");
                        }
                    },
                    error: function(error) {
                        console.log("dans error");
                        console.log(error);
                    },
                });
            })
            // console.log(emailElement)
        })
    </script>
</body>

</html>