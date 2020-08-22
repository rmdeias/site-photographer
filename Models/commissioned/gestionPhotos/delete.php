<?php
session_start();

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT categorie, photo FROM commissioned INNER JOIN categorie_Commissioned ON commissioned.id_Categorie = categorie_Commissioned.id WHERE commissioned.id = :id"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $deletePhoto = $query->fetch(PDO::FETCH_ASSOC);

    unlink("assets/images/commissioned/".$deletePhoto["categorie"]."/".$deletePhoto["photo"]);

    $query = $dbh->prepare("DELETE FROM commissioned WHERE id = :id ");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
}

header('Location: commPhoto');
exit();
