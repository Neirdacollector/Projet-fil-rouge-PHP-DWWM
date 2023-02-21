<?php
// Je fait le lien avec les autres pages qui continnent les éléments dont on a besoin
require_once(__DIR__ . '/../db/pdo.php');
require_once(__DIR__ . '/../db/PDOConnexion.php');
require_once(__DIR__ . '/../dao/CentreDAO.php');
require_once(__DIR__ . '/../model/Centre.php');

// Je démarre la session
session_start();

// Je "nettoie" la session en "vidant" les variables de session
$errors = isset($_SESSION["errors"]) ?
    $_SESSION["errors"] : [];
$centre = isset($_SESSION["centre"]) ?
    $_SESSION["centre"] : null;

// J'initialise les variables qui vont m'être utiles pour garder en mémoire les informations que l'utilisateur entre
$namecenter = "";
$adress = "";
$zipcode = 0;
$city = "";

// si la variable centre n'est pas nulle, on stocke les informations qu'elle contient dans differentes variables
if ($centre != null) {
    $namecenter = $centre -> getNamecenter();
    $adress = $centre -> getAdress();
    $zipcode = $centre -> getZipcode();
    $city = $centre -> getCity();
}


// Je "détruit" les variables de sessions 
unset($_SESSION["errors"]);
unset($_SESSION["centre"]);

 //var_dump($centre);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Centre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <!-- On crée un formulaire et on fait en sorte que les informations restant si jamais l'utilisateur entre des mauvaises données  -->
    <h1>Ajouter un Centre</h1>
    <form action="../control/ajoutCentreAction.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="namecenter">Nom du Centre :</label>
            <input type="text" name="namecenter" id="namecenter" value="<?= $namecenter; ?>"><br>
            <?php if (array_key_exists("namecenter", $errors)) : ?>
                <span class="bg-danger">Nom du Centre Invalide</span><br>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="adress">Adresse :</label>
            <input type="adress" name="adress" id="adress" value="<?= $adress; ?>"><br>
            <?php if (array_key_exists("adress", $errors)) : ?>
                <span class="bg-danger">Adresse Invalide</span><br>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="zipcode">Code Postal :</label>
            <input type="number" name="zipcode" id="zipcode" value="<?= $zipcode; ?>"><br>
            <?php if (array_key_exists("zipcode", $errors)) : ?>
                <span class="bg-danger">Code Postal Invalide</span><br>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="city">Ville :</label>
            <input type="test" name="city" id="city" value="<?= $city; ?>"><br>
            <?php if (array_key_exists("city", $errors)) : ?>
                <span class="bg-danger">Ville Invalide</span><br>
            <?php endif; ?>
        </div>
        <div>
            <input type="submit" value="Envoyer">

        </div>


    </form>