<?php

require "Models/connectDataBase.php";

$title = "Personal: Gestion de photos";

$query = $dbh->prepare(
    "SELECT personal.id, photo, categorie, titre, classement FROM personal INNER JOIN categorie_Personal ON personal.id_Categorie = categorie_Personal.id ORDER BY categorie, classement ASC"
);
$query->execute();
$photoPerso = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/admin/gestionPersonal/viewPhoto.phtml";
require "Views/templateAdmin.phtml";