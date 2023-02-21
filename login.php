<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php

    require_once(__DIR__ . '/db/pdo.php');
    require_once(__DIR__ . '/model/User.php');
    include_once(__DIR__ . '/dao/UserDAO.php');
    require_once(__DIR__ . '/model/Role.php');
    require_once(__DIR__ . '/inc/functions.inc.php');


    session_start();

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $pass = $_POST['password'];

        // supprimer les caractères vide

        $email = trim($email);

        // Récupérer l'utilisateur correspondant par l'email
        $userDao = new UserDAO($connexion);
        // Vérifier l'existance de l'utilisateur
        $user = $userDao->getUserByEmail($email);

        // Si l'user existe, vérifier le mot de passe avec la fonction password_hash()

        if ($user != null) {

            if (password_verify($_POST['password'], $user->getPassword())) {
                // enregistrer l'utilisateur dans la session
                $_SESSION['LOGGED_USER'] = $user;
                // redirection vers index.php
                header('location:index.php?login=succes');
                exit;
            }
            header('location:index.php?login=error');
            exit;
        }
        header('location:index.php?login=error');
        exit;
    }

    ?>


    <!-- Modal -->


    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="login.php" method="post" name="login">
                    <div class="modal-body">
                        <div class="form-group">
                            <?php
                            if (isset($_GET['login']) && ($_GET['login'] == 'error')) {

                                echo '<p class="bg-danger text-white text-center border border-warning rounded"> Votre Email ou mot de passe est erroné.</p>';
                            };
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Identifiant</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@&%$+])[A-Za-z0-9@&%$+]{8,}$" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_csrf_token" value="<?= csrfToken() ?>">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <input type="submit" value="Se connecter" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


</body>

</html>