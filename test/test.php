<?php 
require_once __DIR__ . '/../db/pdo.php';
require_once(__DIR__.'/../db/PDOConnexion.php');
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/RoleDAO.php';
require_once __DIR__ . '/../model/Role.php';
require_once __DIR__ . '/../model/User.php';
//require_once __DIR__ . '/../view/ajout_stagiaire2.php';

//echo phpinfo();


$hash = password_hash('test', PASSWORD_DEFAULT);

//echo $hash;

$match = password_verify('test', $hash);
//var_dump($match);


if (isset($_POST['submit'])){
    var_dump($_FILES);
    $file = $_FILES['imageFile'];

        echo basename($file['name']); //renvoi le nom du ficher

        echo pathinfo($file['name'], PATHINFO_EXTENSION); // renvoi l'exention du fichier (jpg, pdf,mp3,...)

        $destinationPath = getcwd().DIRECTORY_SEPARATOR.'pics'.DIRECTORY_SEPARATOR; // getcwd() renvoi le chemin absolu de l'application, DIRECTORY_SEPARATOR : envite les problèmes de chemins dont les "/" et "\" peuvent differer selon le système d'exploitation et créer des problèmes voir génrérer des attaques. Ici on stock notre fichier uplodé dans le dossier "pics" de l'application "projetfilrougeV2"
        echo $destinationPath;


        $targetPath = $destinationPath . basename( $file["name"]);
        echo $targetPath;

        move_uploaded_file($file['tmp_name'], $targetPath); // déplace le fichier dans l'emplacement temporaire jusqu'a sa déstination
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="imageFile" id="imageFile"><br><br>

        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>