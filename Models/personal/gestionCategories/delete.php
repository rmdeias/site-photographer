<?php
session_start();

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";

if (isset($_GET["id"])) {
    $query = $dbh->prepare("SELECT categorie FROM categorie_Personal WHERE id = :id");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $deleteCat = $query->fetch(PDO::FETCH_ASSOC);
    deleteDirectory("assets/images/personal/".$deleteCat["categorie"]);

    $query = $dbh->prepare("DELETE FROM personal WHERE id_Categorie = :id ");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );

    $query = $dbh->prepare("DELETE FROM categorie_Personal WHERE id = :id ");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
}

header('Location: persoCat');
exit();
