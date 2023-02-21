<?php

require_once __DIR__ . '/../db/pdo.php';
require_once(__DIR__ . '/../db/PDOConnexion.php');
require_once __DIR__ . '/../dao/CentreDAO.php';
require_once __DIR__ . '/../model/Centre.php';

// je démarre la session
session_start();

// On initialise les variables, si une variable est non nulle, elle prend la valeur comprise dans le $_POST correspondant (ce que l'utilisateur entre dans le formulaire), sinon elle prend une valeur vide
$namecenter = isset($_POST['namecenter']) ? $_POST['namecenter'] : "";
$adress = isset($_POST['adress']) ? $_POST['adress'] : "";
$zipcode = isset($_POST['zipcode']) ? $_POST['zipcode'] : "";
$city = isset($_POST['city']) ? $_POST['city'] : "";

// J'établi la connexion avec la basse de données et on la stocke dans la variable $centreDao
$centreDao = new CentreDAO($connexion);
// Je crée une nouvelle instance de la class 'Centre', je lui donne les paramêtres des variables que j'ai instancié avec les informations récupérées dans le formulaire 'ajout_centre.php'
$centre = new Centre($namecenter, $adress, $zipcode, $city);

// Dans la variable "$errors" je stocke le resultat de la fontion 'validate()' sur les résultats de l'instanciation de la class 'Centre' pour voir si il y a des erreurs dans ce que l'utilisateur a entré
$errors = $centre -> validate();
//var_dump($_SESSION); (J'en ai eu besoin car j'avais une erreur)
//$centreDao->saveCentre($centre); (pour voir si les information s'inséraient bien dans la base de données avant le controle des erreurs)

// si le nombre d'erreurs est supérieur a 0 alors on renvoi l'utilisateur sur le formulaire pour qu'il corrige ses erreurs
if (count($errors) > 0) {
    $_SESSION["errors"] = $errors;
    $_SESSION["centre"] = $centre;
    //var_dump($errors); pour voir d'ou venait mon erreur
    header('location: ./../view/ajout_centre.php');
    exit;
} else {
    // Si il n'y a pas d'erreurs alors on sauvegarde les informations dans la base de données pour on renvoi l'utilisateur vers l'index.php
    $centreDao->saveCentre($centre);

    header('location: ./../index.php');

    exit;
}