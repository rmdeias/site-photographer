<?php

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";
$title = "Clémentine Passet-Home";

$query = $dbh->prepare("SELECT photo, titre FROM selectedWork ORDER BY classement ASC");
$query->execute();
$carousselPhotos = $query->fetchAll(PDO::FETCH_ASSOC);

require "Views/pages/viewHome.phtml";
require "Views/template.phtml";