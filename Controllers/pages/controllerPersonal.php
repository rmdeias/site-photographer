<?php

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";
$title = "Clémentine Passet - Personnal";

$query = $dbh->prepare("SELECT id,categorie, photoCouv FROM categorie_Personal");
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT photo, categorie, titre FROM personal INNER JOIN categorie_Personal ON personal.id_Categorie = categorie_Personal.id WHERE personal.id_Categorie = :id ORDER BY classement ASC"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $carousselPhotos = $query->fetchAll(PDO::FETCH_ASSOC);
}
require "Views/pages/viewPersonal.phtml";
require "Views/template.phtml";