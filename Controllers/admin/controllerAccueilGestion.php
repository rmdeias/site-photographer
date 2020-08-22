<?php

$title = "Accueil Admin";

if ($_GET["page"] == "select") {
    $title = "Selected Work";
    $gestPhotos = "selectPhoto";
}

if ($_GET["page"] == "comm") {
    $title = "Commissioned";
    $gestCat = "commCat";
    $gestPhotos = "commPhoto";
}

if ($_GET["page"] == "still") {
    $title = "Still Life";
    $gestCat = "stillCat";
    $gestPhotos = "stillPhoto";
}

if ($_GET["page"] == "fash") {
    $title = "Fashion";
    $gestCat = "fashCat";
    $gestPhotos = "fashPhoto";
}

if ($_GET["page"] == "perso") {
    $title = "Personal";
    $gestCat = "persoCat";
    $gestPhotos = "persoPhoto";
}

require "Views/admin/viewAccueilGestion.phtml";
require "Views/templateAdmin.phtml";