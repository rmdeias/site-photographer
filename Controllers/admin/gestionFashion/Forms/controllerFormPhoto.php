<?php

require "Models/connectDataBase.php";

$title = "Fashion: Formulaire Photo";
$js = "assets/js/fashion_FormPhoto.js";

$query = $dbh->prepare("SELECT categorie, id FROM categorie_Fashion");
$query->execute();
$listeCategories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT fashion.id,fashion.id_Categorie, titre, classement, categorie FROM fashion INNER JOIN categorie_Fashion ON fashion.id_Categorie = categorie_Fashion.id  WHERE fashion.id = :id"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $listePhoto = $query->fetch(PDO::FETCH_ASSOC);
}

require "Views/admin/gestionFashion/Forms/viewFormPhoto.phtml";
require "Views/templateAdmin.phtml";