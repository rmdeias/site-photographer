<?php

require "Models/connectDataBase.php";

$title = "Fashion: Gestion de catégorie";

$query = $dbh->prepare("SELECT id, categorie, photoCouv FROM categorie_Fashion");
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/admin/gestionFashion/viewCategorie.phtml";
require "Views/templateAdmin.phtml";