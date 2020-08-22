<?php

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";
$title = "Clémentine Passet - Commissioned";

$query = $dbh->prepare("SELECT id,categorie, photoCouv FROM categorie_Commissioned");
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT photo, categorie, titre FROM commissioned INNER JOIN categorie_Commissioned ON commissioned.id_Categorie = categorie_Commissioned.id WHERE commissioned.id_Categorie = :id ORDER BY classement ASC"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $carousselPhotos = $query->fetchAll(PDO::FETCH_ASSOC);
}

require "Views/pages/viewCommissioned.phtml";
require "Views/template.phtml";