<?php

require "Models/connectDataBase.php";

$title = "Commissioned: Gestion de photos";

$query = $dbh->prepare(
    "SELECT commissioned.id, photo, categorie, titre, classement FROM commissioned INNER JOIN categorie_Commissioned ON commissioned.id_Categorie = categorie_Commissioned.id ORDER BY categorie, classement ASC"
);
$query->execute();
$photoCom = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/admin/gestionCommissioned/viewPhoto.phtml";
require "Views/templateAdmin.phtml";