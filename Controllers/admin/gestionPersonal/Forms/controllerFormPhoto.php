<?php

require "Models/connectDataBase.php";

$title = "Personal: Formulaire photo";
$js = "assets/js/personal_FormPhoto.js";

$query = $dbh->prepare("SELECT categorie, id FROM categorie_Personal");
$query->execute();
$listeCategories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT personal.id,personal.id_Categorie, titre, classement, categorie FROM personal INNER JOIN categorie_Personal ON personal.id_Categorie = categorie_Personal.id  WHERE personal.id = :id"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $listePhoto = $query->fetch(PDO::FETCH_ASSOC);
}

require "Views/admin/gestionPersonal/Forms/viewFormPhoto.phtml";
require "Views/templateAdmin.phtml";