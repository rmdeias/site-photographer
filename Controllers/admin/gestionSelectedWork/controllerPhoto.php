<?php

require "Models/connectDataBase.php";

$title = "Selected Work: Gestion de photos";

$query = $dbh->prepare("SELECT id, photo, titre, classement FROM selectedWork ORDER BY classement ASC");
$query->execute();
$photoSelect = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/admin/gestionSelectedWork/viewPhoto.phtml";
require "Views/templateAdmin.phtml";