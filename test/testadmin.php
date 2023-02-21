<?php
require_once __DIR__ . '/../db/pdo.php';
require_once(__DIR__ . '/../db/PDOConnexion.php');
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/RoleDAO.php';
require_once __DIR__ . '/../model/Role.php';
require_once __DIR__ . '/../model/User.php';


/* function loggedAdmin($role){
    if (isset($_SESSION['LOGGED_USER'])) {

            $user = $_SESSION['LOGGED_USER'];
            //var_dump($user);
            $role = $user->getRole()->getNom(); // ADMIN ou FORMATEUR ou STAGIAIRE
          return $role;
        }
} */