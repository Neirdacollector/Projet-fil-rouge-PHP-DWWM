<?php

/* function csrfToken(){
    unset($_SESSION["_csrf_token"]);
    $jeton = '4';
    if (isset($_SESSION["_csrf_token"])) {
        $jeton = $_SESSION["_csrf_token"];
    } else {
        $jeton = generateToken();
        $_SESSION["_csrf_token"] = $jeton;
        return $jeton;
    }
} */