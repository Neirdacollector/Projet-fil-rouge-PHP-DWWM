<?php

require_once(__DIR__ . '/model/User.php');
require_once(__DIR__ . '/model/Role.php');
require_once(__DIR__ . '/inc/functions.inc.php');
session_set_cookie_params([
    'lifetime' => 3600 * 24, //1 jour
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => false, // a modifier plus tard
    'httponly' => true,
    'samesite' => 'lax'
]);

require_once(__DIR__ . '/inc/team.inc.php');
include_once(__DIR__ . '/login.php');

//session_start();

$user = isset($_SESSION['LOGGED_USER']) ? $_SESSION['LOGGED_USER'] : null;
$role = isset($_SESSION['LOGGED_USER']) ? $_SESSION['LOGGED_USER'] : null;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>


<body class="container">
    <div class="jumbotron">
        <h1 class="display-4">Bienvenue <?= $user == null ? "abonné(e)" : $user->getPrenom() ?>!</h1>
        <p class="lead">Cet espace est réservé aux abonné.e.s du Greta de Levallois. Il est en place depuis <?= countDays() ?> jours. Il compte aujourd'hui xxx abonné.e.s.</p>
        <hr class="my-3">
        <?php if ($user == null) : ?>
            <p>Cliquer sur le bouton ci-dessous pour vous identifier :</p>
            <button class="btn btn-success" id="btnLogin" data-toggle="modal" data-target="#staticBackdrop">Se connecter</button>
        <?php else : ?>
            <p>Cliquer sur le bouton ci-dessous pour vous deconnecter :</p>
            <a href="logout.php" class="btn btn-danger" id="btnLogout" data-target="#staticBackdrop">Se déconnecter</a>
        <?php endif ?>
        <?php if (loggedUserRole() == 'Admin') : ?>
            <p>Cliquer sur un des boutons ci-dessous pour ajouter un nouvel utilisateur ou un nouveau centre :</p>
            <button class="btn btn-warning" id="btnLogin" data-toggle="modal" data-target="#staticBackdrop"><a href="http://localhost/module7/projetfilrougeV3/view/ajout_user.php">Ajouter Utilisateur</a></button>
            <button class="btn btn-warning" id="btnLogin" data-toggle="modal" data-target="#staticBackdrop"><a href="http://localhost/module7/projetfilrougeV3/view/ajout_centre.php">Ajouter Centre</a></button>
        <?php endif ?>


    </div>
    <section class="d-flex flex-wrap">
        <?php
        // On appelle la fonction 'cards' seulement si l'utilisateur est connecté
        if ($user == null) {
            echo "Connectez vous pour voir les Utilisateurs";
        } else {
            cards($users);
        }

        ?>

    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <?php

    /* if (isset($_GET['login']) && ($_GET['login'] == 'succes')) {

        echo "<script>alert('Bienvenue " . $user->getPrenom() . "');</script>";
    }; */

    /* if (isset($_GET['logout']) && ($_GET['logout'] == 'succes')) {

        echo "<script>alert('Vous avez été déconnecté');</script>";
    }; */

    if (isset($_GET['login']) && ($_GET['login'] == 'error')) {

        echo "<script>$('#staticBackdrop').modal('show');</script>";
    };

    ?>

</body>

</html>