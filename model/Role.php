<?php 
// Denis Adrien ( pas terminé)
class Role{

    private $id;
    private $nom;

    public function __construct($id, $nom){

        $this -> setId($id);
        $this->setNom($nom);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nomrole
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nomrole
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
}


?>