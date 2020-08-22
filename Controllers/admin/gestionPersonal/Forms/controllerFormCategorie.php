<?php

require "Models/connectDataBase.php";

$title = "Personal: Formulaire catégorie";
$js = "assets/js/personal_FormCategorie.js";

if (isset($_GET["id"])) {
    $query = $dbh->prepare("SELECT id, photoCouv, categorie FROM categorie_Personal WHERE id = :id");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $listeCategorie = $query->fetch(PDO::FETCH_ASSOC);
}

require "Views/admin/gestionPersonal/Forms/viewFormCategorie.phtml";
require "Views/templateAdmin.phtml";