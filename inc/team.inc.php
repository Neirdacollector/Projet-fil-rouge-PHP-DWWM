<?php
//echo __DIR__;
require_once(__DIR__.'/../db/pdo.php');
require_once(__DIR__.'/../dao/UserDAO.php');
require_once(__DIR__.'/../model/User.php');

// on créer userDao

$userDAO = new UserDAO($connexion);

$users = $userDAO -> getUsers();
// // var_dump($users);

// $user = new User("Rokia@gmail.com", 'Coulibaly', 'Rokia', '1982-04-05','F','170','Rokia++6');
// $role = new Role(3, 'Admin');
// $user -> setRole($role);
//$userDAO -> saveUser($user);

/* $filles = array(
    array(
        "Nom" => "Lea",
        "Female" => true,
        "Dob" => "1988-02-25",
        "Size" => 1.66,
        "Email" => "lea@greta.com",
    ),

    array(
        "Nom" => "Fatima",
        "Female" => true,
        "Dob" => "1987-06-24",
        "Size" => 1.64,
        "Email" => "fatima@greta.com",
    ),

    array(
        "Nom" => "Anaïs",
        "Female" => true,
        "Dob" => "1998-09-12",
        "Size" => 1.62,
        "Email" => "anais@greta.com",
    ),

    array(
        "Nom" => "Audrey",
        "Female" => true,
        "Dob" => "1977-07-24",
        "Size" => 1.63,
        "Email" => "audrey@greta.com",
    ),

    array(
        "Nom" => "Gaby",
        "Female" => true,
        "Dob" => "2000-11-27",
        "Size" => 1.61,
        "Email" => "gaby@greta.com",
    ),

);

$garcons = array(
    array(
        "Nom" => "Adrien",
        "Female" => false,
        "Dob" => "1992-05-28",
        "Size" => 1.86,
        "Email" => "adrien@greta.com",
    ),

    array(
        "Nom" => "Amine",
        "Female" => false,
        "Dob" => "1987-07-11",
        "Size" => 1.86,
        "Email" => "amine@greta.com",
    ),

    array(
        "Nom" => "Thomas",
        "Female" => false,
        "Dob" => "1987-09-11",
        "Size" => 1.68,
        "Email" => "thomas@greta.com",
    ),

    array(
        "Nom" => "Nabil",
        "Female" => false,
        "Dob" => "1987-09-20",
        "Size" => 1.75,
        "Email" => "nabil@greta.com",
    ),

    array(
        "Nom" => "Guillhem",
        "Female" => false,
        "Dob" => "1997-03-15",
        "Size" => 1.74,
        "Email" => "guillhem@greta.com",
    ),

);

$formateurs = array(
    array(
        "Nom" => "Saman",
        "Female" => false,
        "Dob" => "1993-10-09",
        "Size" => 1.80,
        "Email" => "saman@greta.com",
    ),

    array(
        "Nom" => "Nadjet",
        "Female" => true,
        "Dob" => "1982-08-22",
        "Size" => 1.60,
        "Email" => "nadjet@greta.com",
    ),

    array(
        "Nom" => "Jean-Damien",
        "Female" => false,
        "Dob" => "1975-05-11",
        "Size" => 1.75,
        "Email" => "jdt@greta.com",
    ),
); */


 /* $greta = array_merge($filles, $garcons, $formateurs); */
//var_dump($greta);






