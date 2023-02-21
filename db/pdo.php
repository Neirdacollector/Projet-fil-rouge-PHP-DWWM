<?php 
// Denis Adrien ( pas terminé)
require_once(__DIR__.'/PDOConnexion.php');

$dsn = 'mysql:host=localhost;port=3306;dbname=projetfilrouge;charset=utf8';
    $user = 'projetfilrouge'; // temporaire
    $pass = '123456'; // temporaire
    

$connexion = PDOConnexion::getConnexion($dsn, $user, $pass);

?>