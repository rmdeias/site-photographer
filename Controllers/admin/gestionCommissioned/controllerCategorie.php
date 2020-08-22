<?php

require "Models/connectDataBase.php";

$title = "Commissioned: Gestion de catégorie";

$query = $dbh->prepare("SELECT id, categorie, photoCouv FROM categorie_Commissioned");
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/admin/gestionCommissioned/viewCategorie.phtml";
require "Views/templateAdmin.phtml";