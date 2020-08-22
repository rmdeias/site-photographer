<?php

require "Models/connectDataBase.php";

$title = "Fashion: Gestion de photos";

$query = $dbh->prepare(
    "SELECT fashion.id, photo, categorie, titre, classement FROM fashion INNER JOIN categorie_Fashion ON fashion.id_Categorie = categorie_Fashion.id ORDER BY categorie, classement ASC"
);
$query->execute();
$photoFash = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/admin/gestionFashion/viewPhoto.phtml";
require "Views/templateAdmin.phtml";