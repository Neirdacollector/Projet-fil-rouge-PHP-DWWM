<?php
// Denis Adrien ( pas terminé)
require_once(__DIR__.'/../exceptions/Nom_prenom_exception.php');
require_once(__DIR__.'/../exceptions/DobInvalidException.php');
require_once(__DIR__.'/../exceptions/GenreInvalidException.php');
require_once(__DIR__.'/../exceptions/TailleInvalidException.php');
require_once(__DIR__.'/../exceptions/EmailInvalideException.php');
require_once(__DIR__.'/../exceptions/PasswordInvalidException.php');


class User
{
    // Denis Adrien ( pas terminé)

    private $email;
    private $nom;
    private $prenom;
    private $dob;
    private $genre;
    private $taille;
    private $password;
    private $role;
    private $image;

    const MALE = 'M';
    const FEMALE = 'F';

    public function __construct($email, $nom, $prenom, $dob, $genre, $taille, $password, $image)
    {

        $this->setEmail($email);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setDob($dob);
        $this->setGenre($genre);
        $this->setTaille($taille);
        $this->setPassword($password);
        $this->setImage($image);
        
    }

    public function validate():array
        {
            $errors = [];
            try {
                $this->validateEmail($this->email);
            } catch (\Throwable $th) {
                $errors["email"] = true;
            }
            try {
                $this->validateNom($this->nom);
            } catch (\Throwable $th) {
                $errors["nom"] = true;
            }
            try {
                $this->validatePrenom($this->prenom);
            } catch (\Throwable $th) {
                $errors["prenom"] = true;
            }
            try {
                $this->validateTaille($this->taille);
            } catch (\Throwable $th) {
                $errors["taille"] = true;
            }
            try {
                $this->validateDob($this->dob);
            } catch (\Throwable $th) {
                $errors["dateNaissance"] = true;
            }
            try {
                $this->validateGenre($this->genre);
            } catch (\Throwable $th) {
                $errors["sexe"] = true;
            }
            try {
                $this->validatePassword($this->password);
            } catch (\Throwable $th) {
                $errors["password"] = true;
            }

            return $errors;
            
        }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        //protection contre la faille XSS

        return htmlspecialchars($this->email);
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $email = trim($email);

            $this->email = $email;

            return $this;
        
            
        
    }

    public function validateEmail($email){

        if (!str_ends_with($email, "@gmail.com")){
            throw new EmailInvalideException();
        }

    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return htmlspecialchars($this->nom);
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {

            $nom = trim($nom);

                $this->nom = $nom;

                return $this;
            
    }

    private function validateNom($nom){

        if (empty($nom)){
            throw new EmailInvalideException();
        }

    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return htmlspecialchars($this->prenom);
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
            $prenom = trim($prenom);

                $this->prenom = $prenom;

                return $this;

    }

    private function validatePrenom($prenom){

        if (empty($prenom)){
            throw new EmailInvalideException();
        }

    }

    /**
     * Get the value of dob
     */
    public function getDob()
    {
        return htmlspecialchars($this->dob);
    }

    /**
     * Set the value of dob
     *
     * @return  self
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }

    private function validateDob($dob){

        $d1 = strtotime($dob);//retourne le nombre de secondes écoulé depuis 1er janvier 1970
        $d2 = strtotime("now");
        if ($d1 != false) {
            $diff = $d2-$d1;//age en secondes
            if ($diff > 0) {
                $age = floor($diff/60/60/24/365);//Arrondit à l'entier inférieur
                if ($age < 18) {
                    
                    throw new DobInvalideException();
                }
            }else{
                    throw new DobInvalideException(); 
            }
        }else{

                throw new DobInvalideException();
                   }

    

    }




    /**
     * Get the value of genre
     */
    public function getGenre()
    {
        return htmlspecialchars($this->genre);
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */
    public function setGenre($genre)
    {
        /* if ($genre == "M" || $genre == "F") {
            $this->genre = $genre;

            return $this;
        } else {
            throw new GenreInvalidException();
        }
 */
        $this->genre = $genre;

            return $this;
    }

    private function validateGenre($genre){

        if ($genre != self::MALE && $genre != self::FEMALE){
            throw new GenreInvalidException();
        }

    }


    /**
     * Get the value of taille
     */
    public function getTaille()
    {
        return htmlspecialchars($this->taille);
    }

    /**
     * Set the value of taille
     *
     * @return  self
     */
    public function setTaille($taille)
    {
       /*  $taille = intval($taille);
        if ($taille >= 100 && $taille <= 250) {
            
        } else {
            throw new TailleInvalidException();
        } */
        $this->taille = $taille;

            return $this;
    }

    private function validateTaille($taille){

        $taille = intval($taille);
        if ($taille < 100 || $taille > 250) {
            
            throw new TailleInvalidException();
        }

    }


    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

            return $this;
    }

    private function validatePassword($password){

        $motif = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@&%$+])[A-Za-z0-9@&%$+]{8,}$/";
            if (!preg_match($motif, $password)) {
                throw new Exception();
            }

    }


    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
