<?php
session_start();

require "../connectDataBase.php";

$_POST["Email"] = htmlspecialchars($_POST["Email"]);
$_POST["Password"] = htmlspecialchars($_POST["Password"]);
$passRegex = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';

$query = $dbh->prepare("SELECT id, Email, adminPassword FROM ConnectAdmin WHERE id = id");
$query->execute();
$admin = $query->fetch(PDO::FETCH_ASSOC);

if (isset($admin["Email"]) && isset($admin["adminPassword"])) {
    $_SESSION["admin"] = [
        "id" => $admin["id"],
        "Email" => $admin["Email"],
        "Password" => $admin["adminPassword"],
    ];

    if ($admin["Email"] === $_POST["Email"] && password_verify($_POST["Password"], $admin["adminPassword"])) {
        header('Location: ../../gestion');
        exit;
    } else {
        die("Informations incorrectes");
    }
} else {
    if (preg_match($passRegex, $_POST["Password"]) && filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
        $query = $dbh->prepare("INSERT INTO ConnectAdmin (Email, adminPassword) Values (:Email, :Password)");
        $query->execute(
            [
                "Email" => $_POST["Email"],
                "Password" => password_hash($_POST["Password"], PASSWORD_DEFAULT),
            ]
        );
        header('Location: ../../connection');
        exit;
    } else {
        die("Adresse mail non valide ou votre Mot de passe ne contient pas 8 caractères avec au moins un chiffre , une majuscule et un caractère spécial");
    }
}
