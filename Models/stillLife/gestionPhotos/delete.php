<?php
session_start();

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT categorie, photo FROM stillLife INNER JOIN categorie_StillLife ON stillLife.id_Categorie = categorie_StillLife.id WHERE stillLife.id = :id"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $deletePhoto = $query->fetch(PDO::FETCH_ASSOC);

    unlink("assets/images/stillLife/".$deletePhoto["categorie"]."/".$deletePhoto["photo"]);

    $query = $dbh->prepare("DELETE FROM stillLife WHERE id = :id ");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
}

header('Location: stillPhoto');
exit();
