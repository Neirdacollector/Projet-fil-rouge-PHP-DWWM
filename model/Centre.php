<?php
// appel de la page d'exceptions
require_once(__DIR__ . '/../exceptions/CenterInvalideException.php');

// Je crée la classe Centre qui contient differents parametres dont j'aurais besoin pour créer des instances de cette même classe.  

class Centre {
    //Je passe les variables en privé pour ne pas qu'elles puissent être modifiées par n'importe qui
    private $namecenter;
    private $adress;
    private $zipcode;
    private $city;

    // Je crée un constructeur qui contient les attributs dont j'aurais besoin dans cette classe "Centre", le contructeur est public car on doit pouvoir entrer les informations que l'on veut 

    public function __construct($namecenter, $adress, $zipcode, $city){

        // J'affecte une valeur aux attributs de la class "Centre" grace au contructeur(getter/setter) 
        $this->setNamecenter($namecenter);
        $this->setAdress($adress);
        $this->setZipcode($zipcode);
        $this->setCity($city);
    }

    // création de la fonction "validate" qui vérifies si les conditions demandées dans les setter sont bien remplies dans le block "try", si ce n'est pas le cas, le block "catch" retoune l'erreur et le reste du code ne s'execute pas
    public function validate():array{

        $errors = [];
        try {
            $this->validateNamecenter($this->namecenter);
        } catch (\Throwable $th) {
            $errors["namecenter"] = true;
        }
        try {
            $this->validateAdress($this->adress);
        } catch (\Throwable $th) {
            $errors["adress"] = true;
        }
        try {
            $this->validateZipcode($this->zipcode);
        } catch (\Throwable $th) {
            $errors["zipcode"] = true;
        }
        try {
            $this->validateCity($this->city);
        } catch (\Throwable $th) {
            $errors["city"] = true;
        }

        return $errors;

    } 
    //-------------- JE crée les accesseurs (Getter/Setter) et leur affecte des conditions et des exceptions pour ne pas que l'utilisateur du site puisse faire ce qu'il veut  
    /**
     * Get the value of namecenter
     */ 
    public function getNamecenter() // Le getter lit les informations
    {
        return htmlspecialchars($this->namecenter);
        // On évite les injections XSS qui permettent a un utilisateur malveillant d'éjecter du code dans le notre
    }

    /**
     * Set the value of namecenter
     *
     * @return  self
     */ 
    public function setNamecenter($namecenter) //Le setter sert à écrire les informations
    {
        $namecenter = trim($namecenter); // trim() supprime les caratères invisible en début et en fin de string

        $this->namecenter = $namecenter; // écriture de l'attribut

        return $this; // on le retourne 
    }
 // Je crée des fonctions qui me permetterons de gérer les erreurs et retrouner des exceptions 
    private function validateNamecenter($namecenter)
    {

        if (empty($namecenter)) { // si la variable est vide, on retourne un exception
            throw new NamecenterInvalideException();
        }
    }

    /**
     * Get the value of adress
     */ 
    public function getAdress()
    {
        return htmlspecialchars($this->adress);
    }

    /**
     * Set the value of adress
     *
     * @return  self
     */ 
    public function setAdress($adress)
    {
        $adress = trim($adress);

        $this->adress = $adress;

        return $this;
    }

    private function validateAdress($adress)
    {

        if (empty($adress)) {
            throw new AdressInvalideException();
        }
    }

    /**
     * Get the value of zipcode
     */ 
    public function getZipcode()
    {
        return htmlspecialchars($this->zipcode);
    }

    /**
     * Set the value of zipcode
     *
     * @return  self
     */ 
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    private function validateZipcode($zipcode)
    {   // ici on fait le test pour que le code postal respecte bien les conditions 
        $motif = "/^(?:0[1-9]|[1-8]\d|9[0-8])\d{3}$/";
        if (!preg_match($motif, $zipcode)) { 
            throw new ZipcodenvalideException();
        }
    }

    

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return htmlspecialchars($this->city);
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $city = trim($city);

        $this->city = $city;

        return $this;
    }

    private function validateCity($city)
    {

        if (empty($city)) { 
            throw new CityInvalideException();
        }
    }

}