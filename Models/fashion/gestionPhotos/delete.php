<?php
session_start();

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT categorie, photo FROM fashion INNER JOIN categorie_Fashion ON fashion.id_Categorie = categorie_Fashion.id WHERE fashion.id = :id"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $deletePhoto = $query->fetch(PDO::FETCH_ASSOC);

    unlink("assets/images/fashion/".$deletePhoto["categorie"]."/".$deletePhoto["photo"]);

    $query = $dbh->prepare("DELETE FROM fashion WHERE id = :id ");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
}

header('Location: fashPhoto');
exit();
