<?php
// Denis Adrien ( pas terminé)
require_once(__DIR__ . '/../db/pdo.php');
require_once(__DIR__ . '/../db/PDOConnexion.php');
require_once(__DIR__ . '/../dao/UserDAO.php');
require_once(__DIR__ . '/../dao/RoleDAO.php');
require_once(__DIR__ . '/../model/Role.php');
require_once(__DIR__ . '/../model/User.php');


session_start();
unset($_SESSION["errors"]);
//verifier si le formulaire est valide
if (isset($_POST['_csrf_token'])) {
    // si _csrf_token est défini dans le $_POST
    $tokenFormulaire = $_POST['_csrf_token'];
    $tokenSession = $_SESSION['_csrf_token'];
    if ($tokenFormulaire != $tokenSession) {

        header('location: ./../view/ajout_user.php?error=csrf');
        exit;
    }
} else {
    // si _csrf_token n'est pas défini dans le $_POST    
    header('location: ./../view/ajout_user.php?error=csrf');
    exit;
}


$file = isset($_FILES['imageFile']) ? $_FILES['imageFile'] : [];
$email = isset($_POST['email']) ? $_POST['email'] : "";
$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$dob = isset($_POST['dob']) ? $_POST['dob'] : "";
$genre = isset($_POST['genre']) ? $_POST['genre'] : "";
$taille = isset($_POST['taille']) ? $_POST['taille'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$roleId = isset($_POST['role']) ? $_POST['role'] : 0;

$userDao = new UserDAO($connexion);
$user = new User($email, $nom, $prenom, $dob, $genre, $taille, $password, null);

$roleDao = new RoleDAO($connexion);
$role = $roleDao->getRoleById($roleId);
//var_dump($role);

$user->setRole($role);
//validation
$errors = $user->validate();
if (count($errors) > 0) {
    $_SESSION["errors"] = $errors;
    $_SESSION["user"] = $user;
    header('location: ./../view/ajout_user.php');
    exit;
} else {
    try {

        if (isset($file['error']) && $file['error'] == 0) {

            $destinationPath = getcwd() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'pics' . DIRECTORY_SEPARATOR;

            $targetPath = $destinationPath . basename($file["name"]);

            $upload = move_uploaded_file($file['tmp_name'], $targetPath);
            // var_dump($upload);
            if ($upload) {
                $user->setImage(basename($file["name"]));
            }
        }


        $userDao->saveUser($user);
    } catch (\Throwable $th) {
        //var_dump($th);
        // $errors["th"] =$th;
        $errors["email"] = true;
        $_SESSION["errors"] = $errors;

        header('location: ./../view/ajout_user.php');
        exit;
    }

    header('location: ./../index.php');
    exit;
}
