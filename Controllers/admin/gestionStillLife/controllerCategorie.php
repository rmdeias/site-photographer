<?php

require "Models/connectDataBase.php";

$title = "Still Life: Gestion de catégorie";

$query = $dbh->prepare("SELECT id, categorie, photoCouv FROM categorie_StillLife");
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/admin/gestionStillLife/viewCategorie.phtml";
require "Views/templateAdmin.phtml";