<?php
session_start();

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT categorie, photo FROM personal INNER JOIN categorie_Personal ON personal.id_Categorie = categorie_Personal.id WHERE personal.id = :id"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $deletePhoto = $query->fetch(PDO::FETCH_ASSOC);

    unlink("assets/images/personal/".$deletePhoto["categorie"]."/".$deletePhoto["photo"]);

    $query = $dbh->prepare("DELETE FROM personal WHERE id = :id ");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
}

header('Location: persoPhoto');
exit();
