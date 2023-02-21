<?php

// On revoi l'écart entre deux dates passées en parémètres

function age($date1, $date2)
{

    if (strtotime($date1) && strtotime($date2)) {
        $d1 = strtotime($date1);
        $d2 = strtotime($date2);
        if ($d1 > $d2) {
            $gap = $d1 - $d2;
        } else {
            $gap = $d2 - $d1;
        }


        return floor($gap / 60 / 60 / 24 / 365);
    } else {
        trigger_error("Entrez une date valide !", E_USER_ERROR);
        return false;
    }
}

// calcul de l'écart entre deux dates en jours

function countDays(){
    $datecreation = "2022-01-01";
    $today = strtotime("now");
    $start = strtotime($datecreation);
    $count = floor(($today - $start) / 60 / 60 / 24);
    return $count;
}


// function Générer les cards

function cards($greta)
{
    // Définition du pattern - motif ou structure HTML

    $pattern = '<div class="card m-3" style="width:15rem">
     <img src="%s" alt="" class="card-img-top">
     <div class="card-body">
     <h5 class="card-title"><strong>%s</strong> %s</h5>
     <p><strong>Age : </strong>%d ans</p>
     <p><strong>Taille : </strong>%g cm</p>
     <p><strong>Fonction : </strong>%s</p>
     <p><strong>Email : </strong>%s</p>
     
     </div>
     </div>';

    $html = '';
    foreach ($greta as $member) {
        $image = $member->getImage();
        if ($image == null) {
            $image = $member->getGenre() == 'F' ? 'pics/female.jpg' : 'pics/males.jpg';
        } else {
            $image = 'pics/' . $image;
        }
        $html .= sprintf($pattern, $image, $member->getNom(), $member->getPrenom(), age($member->getDob(), date('Y-m-d')), $member->getTaille(), $member->getRole()->getNom(), $member->getEmail());
    }
    echo $html;
}

// Fonction permettant de générer un Token aléatoire

function generateToken()
{
    //gérérer un identifiant unique
    $id = uniqid(); //renvoi un nombre aléatoire en chaine de caractères

    //hacher l'id généré
    $hash = md5($id);

    //retourner le hash
    return $hash;
}

// Fonction permettant de retouner le Token aléatoire si il n'existe pas

function csrfToken()
{
    unset($_SESSION["_csrf_token"]);
    $jeton = '4';
    if (isset($_SESSION["_csrf_token"])) {
        $jeton = $_SESSION["_csrf_token"];
    } else {
        $jeton = generateToken();
        $_SESSION["_csrf_token"] = $jeton;
        return $jeton;
    }
}

// Fonction retournant le role de l'utilisateur (Stagiaire, Formateur ou Admin)
function loggedUserRole()
{
    if (isset($_SESSION['LOGGED_USER'])) {

        $user = $_SESSION['LOGGED_USER'];
        //var_dump($user);
        $role = $user->getRole()->getNom(); // ADMIN ou FORMATEUR ou STAGIAIRE
        return $role;
    }
}

function add($a, $b)
{

    return $a + $b;
}

// ----- sprintf()---------

/* $num = 5;
$location = "bananier";

$pattern = 'il y a un %d singe(s) dans le %s';

echo sprintf($pattern, $num, $location); */

//require_once('team.inc.php');
//include_once('.index.php');

// calculer l'age d'une personne en prennant la date de nassance et la date d'aujourd hui
//faire un trigger error si il y a un problème dans un des paramètres (pas une date, etc)

// ---------- Exercice Renvoyer l'age en fontion de la date de naissance ----------

/* $dob = "1988-05-28";


function returnDob($age)
{

    $dob = "";
    $today = strtotime("now");
    $start = strtotime($age);
    $age = floor(($today - $start) / 60 / 60 / 24 / 365);
    echo "Vous avez $age ans.<br>";
}

function isValidDob($date, $format = 'Y-m-d')
{
    if ($dateTime = DateTime::createFromFormat($format, $date)) {
        /* return  $dateTime && $dateTime->format('Y-m-d') === $date && */
/*         returnDob($date);
    } else {
        trigger_error("Entrez une date valide !", E_USER_ERROR);
    };
}
  */


//returnDob($dob);

//isValidDob($dob);

//var_dump($greta);



/* function connectv2($greta, $login, $password)
{
    $user = null;
    $mdp = 'motdepasse';
    foreach ($greta as $user) {
        if (isset($user['Email']) && $user['mail'] == $login && $password == $mdp) {
            return $user;
        }


        return null;
    }
} */

/* 
function connect($greta, $login, $password)
{

    $user = null;
    $mdp = 'motdepasse';
    foreach ($greta as $u) {

        if (isset($u['Email']) && $u['Email'] == $login && $password == $mdp) {
            $user = $u;
            break;
        }
    }
    return $user;
} */
