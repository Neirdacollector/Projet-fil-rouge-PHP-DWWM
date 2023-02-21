<?php

require_once(__DIR__ . '/../model/Centre.php');

// Création de la class "CentreDAO" pour communiquer avec la base de données, envoyer des informations et en récupérer
class CentreDAO{

    // création de la constante SAVE_CENTER qui contient la requete SQL qui va me permettre de sauvegarder les infomations récupérées dans la table 'centre' de la base de donnée, ici j'utilise des arguments nommés 
    private const SAVE_CENTER =
    'INSERT INTO centre (namecenter, adress, zipcode, city) VALUES (:namecenter, :adress, :zipcode, :city)';

    //On établi la connexion avec la BDD avec ce constructeur (grace a la variable $connexion qui contient les infomations de connexion entre la BDD et le PHP dans PDOConnexion.php et pdo.php)
    private $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }
    
    //Création de la fonction saveCentre() qui permettera d'envoyer les informations que l'utilisateur va entrer dans le formulaire directement dans la BDD grace a la requete SQL que j'ai stocké dans la constante au dessus
    public function saveCentre(Centre $centre){
        
        // Je prépare la requête pour proteger la fonction d'une injection SQL et je la stock dans la variable $statement
        $statement = $this -> connexion -> prepare(self::SAVE_CENTER);

        // Ici je donne une valeur aux arguments nommés et je lui donne les informations récupérées dans le formulaire, je stocke le tout dans un tableau associatif
        $tab = [
            ':namecenter' => $centre -> getNamecenter(),
            ':adress' => $centre -> getAdress(),
            ':zipcode' => $centre -> getZipcode(),
            ':city' => $centre -> getCity(),
        ];

        // j'execute la requête préparée plus au et je lui passe le tableau en argument pour que les informations entrées par l'utilisateur prennent la place des parametres nommés dans la requete SQL
        $statement -> execute($tab);
    }

    
}