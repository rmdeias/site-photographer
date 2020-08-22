<?php

require "Models/connectDataBase.php";

$title = "Commissioned: Formulaire catégorie";
$js = "assets/js/commissioned_FormCategorie.js";

if (isset($_GET["id"])) {
    $query = $dbh->prepare("SELECT id, photoCouv, categorie FROM categorie_Commissioned WHERE id = :id");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $listeCategorie = $query->fetch(PDO::FETCH_ASSOC);
}

require "Views/admin/gestionCommissioned/Forms/viewFormCategorie.phtml";
require "Views/templateAdmin.phtml";