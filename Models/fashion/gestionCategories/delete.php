<?php
session_start();
require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";

if (isset($_GET["id"])) {
    $query = $dbh->prepare("SELECT categorie FROM categorie_Fashion WHERE id = :id");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $deleteCat = $query->fetch(PDO::FETCH_ASSOC);
    deleteDirectory("assets/images/fashion/".$deleteCat["categorie"]);

    $query = $dbh->prepare("DELETE FROM fashion WHERE id_Categorie = :id ");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );

    $query = $dbh->prepare("DELETE FROM categorie_Fashion WHERE id = :id ");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
}

header('Location: fashCat');
exit();
