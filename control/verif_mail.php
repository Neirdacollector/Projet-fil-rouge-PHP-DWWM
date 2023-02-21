<?php
// Denis Adrien ( pas terminé)
    require_once __DIR__ . '/../db/pdo.php';
    require_once __DIR__ . '/../dao/UserDAO.php';
    $userDao = new UserDAO($connexion);

    // var_dump($_POST);
    $res = false;
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    if (!empty($email)) {
        if($userDao->isEmailExist($email)){
            $res = true;
        }
    }

    // on converti un objet PHP en JSON
    echo json_encode(["res"=>$res]);
?>