<?php

require "Models/connectDataBase.php";

$title = "Commissioned: Formulaire Photo";
$js = "assets/js/commissioned_FormPhoto.js";

$query = $dbh->prepare("SELECT categorie, id FROM categorie_Commissioned");
$query->execute();
$listeCategories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id"])) {
    $query = $dbh->prepare(
        "SELECT commissioned.id,commissioned.id_Categorie, titre, classement, categorie FROM commissioned INNER JOIN categorie_Commissioned ON commissioned.id_Categorie = categorie_Commissioned.id  WHERE commissioned.id = :id"
    );
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $listePhoto = $query->fetch(PDO::FETCH_ASSOC);
}

require "Views/admin/gestionCommissioned/Forms/viewFormPhoto.phtml";
require "Views/templateAdmin.phtml";