<?php

require "Models/connectDataBase.php";

$title = "Personal: Gestion de catégorie";

$query = $dbh->prepare("SELECT id, categorie, photoCouv FROM categorie_Personal");
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/admin/gestionPersonal/viewCategorie.phtml";
require "Views/templateAdmin.phtml";