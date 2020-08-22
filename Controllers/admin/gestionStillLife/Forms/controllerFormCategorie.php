<?php

require "Models/connectDataBase.php";

$title = "Still Life: Formulaire catégorie";
$js = "assets/js/stillLife_FormCategorie.js";

if (isset($_GET["id"])) {
    $query = $dbh->prepare("SELECT id, photoCouv, categorie FROM categorie_StillLife WHERE id = :id");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $listeCategorie = $query->fetch(PDO::FETCH_ASSOC);
}

require "Views/admin/gestionStillLife/Forms/viewFormCategorie.phtml";
require "Views/templateAdmin.phtml";
