<?php
// Denis Adrien ( pas terminé)
require_once(__DIR__.'/pdo.php');
// création d'un objet de type PDO
// implémentation du patron de conception "singleton"
// on autorise une seule instance de la classe PDO dans notre application

class PDOConnexion
{
    private static $connexion = null;

    private function  __construct()
    {
        // on met la fonction "__construct()" en privé pour empècher toute personne de créer une nouvelle instance de "PDOConnexion"
    }

    public static function getConnexion($dsn, $user, $pass)
    {
        if (self::$connexion != null) {
            //echo "connexion existante";
            return self::$connexion;
        }
        self::$connexion = new PDO($dsn, $user, $pass);
        self::$connexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$connexion ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        //echo "nouvelle connexion";
        return self::$connexion;
    }
}
?>