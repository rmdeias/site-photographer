<?php

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";
$title = "Clémentine Passet - Fashion";

$query = $dbh->prepare("SELECT id,categorie, photoCouv FROM categorie_Fashion");
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT photo, categorie, titre FROM fashion INNER JOIN categorie_Fashion ON fashion.id_Categorie = categorie_Fashion.id WHERE fashion.id_Categorie = :id ORDER BY classement ASC"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $carousselPhotos = $query->fetchAll(PDO::FETCH_ASSOC);
}
require "Views/pages/viewFashion.phtml";
require "Views/template.phtml";