<?php

require "Models/connectDataBase.php";

$title = "Still Life: Gestion de photos";

$query = $dbh->prepare(
    "SELECT stillLife.id, photo, categorie, titre, classement FROM stillLife INNER JOIN categorie_StillLife ON stillLife.id_Categorie = categorie_StillLife.id ORDER BY categorie, classement ASC"
);
$query->execute();
$photoStill = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/admin/gestionStillLife/viewPhoto.phtml";
require "Views/templateAdmin.phtml";