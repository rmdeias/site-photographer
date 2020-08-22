<?php

require "Models/connectDataBase.php";

$title = "Fashion: Formulaire catégorie";
$js = "assets/js/fashion_FormCategorie.js";

if (isset($_GET["id"])) {
    $query = $dbh->prepare("SELECT id, photoCouv, categorie FROM categorie_Fashion WHERE id = :id");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $listeCategorie = $query->fetch(PDO::FETCH_ASSOC);
}

require "Views/admin/gestionFashion/Forms/viewFormCategorie.phtml";
require "Views/templateAdmin.phtml";