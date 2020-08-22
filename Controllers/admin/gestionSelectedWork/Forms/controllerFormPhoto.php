<?php

require "Models/connectDataBase.php";

$title = "Selected Work: Formulaire photo";
$js = "assets/js/selectedWork_FormPhoto.js";

if (isset($_GET["id"])) {
    $query = $dbh->prepare("SELECT id, titre, classement FROM selectedWork WHERE id = :id");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $listePhoto = $query->fetch(PDO::FETCH_ASSOC);
}

require "Views/admin/gestionSelectedWork/Forms/viewFormPhoto.phtml";
require "Views/templateAdmin.phtml";