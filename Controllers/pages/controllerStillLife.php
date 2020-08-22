<?php

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";
$title = "Clémentine Passet - Still Life";

$query = $dbh->prepare("SELECT id,categorie, photoCouv FROM categorie_StillLife");
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT photo, categorie, titre FROM stillLife INNER JOIN categorie_StillLife ON stillLife.id_Categorie = categorie_StillLife.id WHERE stillLife.id_Categorie = :id ORDER BY classement ASC"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $carousselPhotos = $query->fetchAll(PDO::FETCH_ASSOC);
}
require "Views/pages/viewStillLife.phtml";
require "Views/template.phtml";