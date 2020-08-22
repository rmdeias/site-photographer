<?php

require "Models/connectDataBase.php";

$title = "Still Life: Formulaire photo";
$js = "assets/js/stillLife_FormPhoto.js";

$query = $dbh->prepare("SELECT categorie, id FROM categorie_StillLife");
$query->execute();
$listeCategories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT stillLife.id, stillLife.id_Categorie, titre, classement, categorie FROM stillLife INNER JOIN categorie_StillLife ON stillLife.id_Categorie = categorie_StillLife.id  WHERE stillLife.id = :id"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $listePhoto = $query->fetch(PDO::FETCH_ASSOC);
}

require "Views/admin/gestionStillLife/Forms/viewFormPhoto.phtml";
require "Views/templateAdmin.phtml";
