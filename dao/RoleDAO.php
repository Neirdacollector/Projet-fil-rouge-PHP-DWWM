<?php 
// Denis Adrien ( pas terminé)
require_once(__DIR__.'/../model/User.php');
require_once(__DIR__.'/../model/Role.php');

class RoleDAO{

    private const GET_ROLES = 'SELECT * FROM role'; 
    private const GET_BY_ID = 'SELECT * FROM role WHERE id=?';

    private $connexion;

    public function __construct($connexion){
        $this -> connexion = $connexion;
    }

    private function lineToRole(array $roleTab):Role{
        $role = new Role($roleTab['id'],$roleTab['nom']);

        return $role;
    }

    public function getRoles(){

        $res = [];

        $statements = $this -> connexion -> prepare(self::GET_ROLES);
        $statements -> execute();

        while($roleTab = $statements -> fetch()){
            $role = $this -> linetoRole($roleTab);

            $res[] = $role;
        }
        return $res;
    }

    public function getRoleById($id){

        $statement = $this -> connexion -> prepare(self::GET_BY_ID);
        $statement -> bindParam(1, $id);
        $statement -> execute();

        $ligne = $statement -> fetch();
        $role = new Role($ligne['id'],$ligne['nom']);

        return $role;

            
        }
        
    

    
}

?>