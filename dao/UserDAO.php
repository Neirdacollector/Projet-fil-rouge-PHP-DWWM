<?php 
// Denis Adrien ( pas terminé)
require_once(__DIR__.'/../model/User.php');
require_once(__DIR__.'/../model/Role.php');


class UserDAO{

    private const GET_USERS = 'SELECT u.*, r.nom as role_nom FROM utilisateur u JOIN role r ON u.role_id=r.id;';
    private const SAVE_USER = 'INSERT INTO utilisateur (email, nom, prenom, dob, genre, taille, password, role_id, image) VALUES(:email, :nom, :prenom, :dob, :genre, :taille, :password, :roleId, :image)';
    private const EMAIL_EXISTS ='SELECT count(*) as compteur FROM `utilisateur` WHERE email=?';
    private const GET_USER_BY_EMAIL ='SELECT u.*, r.nom as role_nom FROM utilisateur u JOIN role r on u.role_id = r.id WHERE email=?';

    private $connexion;

    public function __construct($connexion){
        $this -> connexion = $connexion;
    }
    
        
    

    public function getUsers():array{

        $res = [];

        $statements = $this -> connexion -> prepare(self::GET_USERS);
        $statements -> execute();


        while($userTab = $statements -> fetch()){
            $user = $this -> linetoUser($userTab);

            $role = new Role($userTab['role_id'], $userTab['role_nom']);

            $user -> setRole($role);

            $res[] = $user;
        }
        return $res;
    }

    public function saveUser(User $user){

        $statement = $this -> connexion -> prepare(self::SAVE_USER);

        $passwordHash = password_hash($user ->getPassword(), PASSWORD_DEFAULT);

        /* $email = $user -> getEmail();
        $nom = $user -> getNom();
        $prenom = $user-> getPrenom();
        $dob = $user -> getDob();
        $genre = $user -> getGenre();
        $taille = $user -> getTaille();
        $password = $user -> getPassword();
        $role_id = $user -> getRole() -> getId(); */
        
        /* $statement -> bindParam(":email", $email);
        $statement -> bindParam(":nom", $nom);
        $statement -> bindParam(":prenom", $prenom);
        $statement -> bindParam(":dob", $dob);
        $statement -> bindParam(":genre", $genre);
        $statement -> bindParam(":taille", $taille);
        $statement -> bindParam(":password", $password);
        $statement -> bindParam(":roleId", $role_id); */

        $tab = [
            ':email' => $user -> getEmail(),
            ':nom' => $user -> getNom(),
            ':prenom' => $user -> getPrenom(),
            ':dob' => $user -> getDob(),
            ':genre' => $user -> getGenre(),
            ':taille' => $user -> getTaille(),
            ':password' => $passwordHash, // hachage effectué
            ':roleId' => $user -> getRole() -> getId(),
            ':image' => $user -> getImage() ? $user -> getImage() : null,
        ];

        $statement -> execute($tab);

        /* return $this -> connexion -> lastInsertId(); */
    }

    public function isEmailExist($email){

        $statement = $this -> connexion -> prepare(self::EMAIL_EXISTS);
        $statement -> execute([$email]);
        $tab = $statement -> fetch();
        $compteur = ($tab['compteur']);
        return $compteur > 0;

    }

    public function getUserByEmail($email){

        $statement = $this -> connexion -> prepare(self::GET_USER_BY_EMAIL);
        
        $statement -> execute([$email]);

        $ligne = $statement -> fetch();
        if($ligne){
            $user = new User(
                $ligne['email'],
                $ligne['nom'],
                $ligne['prenom'],
                $ligne['dob'],
                $ligne['genre'],
                $ligne['taille'],
                $ligne['password'],
                $ligne['image'],

            );

            $role = new Role($ligne['role_id'], $ligne['role_nom']);

            $user -> setRole($role);

            return $user;

        }

        return null;

       

    }


    private function lineToUser(array $userTab):User{
        $user = new User($userTab['email'], $userTab['nom'], $userTab['prenom'], $userTab['dob'], $userTab['genre'], $userTab['taille'], $userTab['password'], $userTab['image']);

        return $user;
    }


}

?>