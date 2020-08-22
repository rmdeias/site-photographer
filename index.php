<?php
session_start();

$page = $_GET["page"] ?? 'home';
$controller = 'Controllers/pages/controller'.ucfirst($page).'.php';
if (file_exists($controller)) {
    require $controller;
    exit;
}

if (!isset($_SESSION["admin"])) {
    http_response_code(404);
    require "Controllers/pages/Error404.php";
    die();
}

$controller = null;
switch ($_GET["page"]) {
    case"gestion":
        $controller = "Controllers/admin/controllerAccueilGestion.php";
        break;

    /********************** Selected Work ***************************/
    case"select":
        $controller = "Controllers/admin/controllerAccueilGestion.php";
        break;

    case"selectPhoto":
        $controller = "Controllers/admin/gestionSelectedWork/controllerPhoto.php";
        break;

    /********************** Commissioned ***************************/
    case"comm":
        $controller = "Controllers/admin/controllerAccueilGestion.php";
        break;

    case"commCat":
        $controller = "Controllers/admin/gestionCommissioned/controllerCategorie.php";
        break;

    case"commPhoto":
        $controller = "Controllers/admin/gestionCommissioned/controllerPhoto.php";
        break;

    /********************** Still Life ***************************/
    case"still":
        $controller = "Controllers/admin/controllerAccueilGestion.php";
        break;

    case"stillCat":
        $controller = "Controllers/admin/gestionStillLife/controllerCategorie.php";
        break;

    case"stillPhoto":
        $controller = "Controllers/admin/gestionStillLife/controllerPhoto.php";
        break;

    /********************** Fashion ***************************/
    case"fash":
        $controller = "Controllers/admin/controllerAccueilGestion.php";
        break;

    case"fashCat":
        $controller = "Controllers/admin/gestionFashion/controllerCategorie.php";
        break;

    case"fashPhoto":
        $controller = "Controllers/admin/gestionFashion/controllerPhoto.php";
        break;

    /********************** Personal ***************************/
    case"perso":
        $controller = "Controllers/admin/controllerAccueilGestion.php";
        break;

    case"persoCat":
        $controller = "Controllers/admin/gestionPersonal/controllerCategorie.php";
        break;

    case"persoPhoto":
        $controller = "Controllers/admin/gestionPersonal/controllerPhoto.php";
        break;

    case"connectionUp":
        $controller = "Models/AdminConnection.php";
        break;
    /********************** Forms Categories ***************************/
    case"commCatForm":
        $controller = "Controllers/admin/gestionCommissioned/Forms/controllerFormCategorie.php";
        break;

    case"stillCatForm":
        $controller = "Controllers/admin/gestionStillLife/Forms/controllerFormCategorie.php";
        break;

    case"fashCatForm":
        $controller = "Controllers/admin/gestionFashion/Forms/controllerFormCategorie.php";
        break;

    case"persoCatForm":
        $controller = "Controllers/admin/gestionPersonal/Forms/controllerFormCategorie.php";
        break;

    /********************** Delete Categories ***************************/
    case"commCatDelete":
        $controller = "Models/commissioned/gestionCategories/delete.php";
        break;

    case"stillCatDelete":
        $controller = "Models/stillLife/gestionCategories/delete.php";
        break;

    case"fashCatDelete":
        $controller = "Models/fashion/gestionCategories/delete.php";
        break;

    case"persoCatDelete":
        $controller = "Models/personal/gestionCategories/delete.php";
        break;

    /********************** Forms Photos ***************************/
    case"selectPhotoForm":
        $controller = "Controllers/admin/gestionSelectedWork/Forms/controllerFormPhoto.php";
        break;

    case"commPhotoForm":
        $controller = "Controllers/admin/gestionCommissioned/Forms/controllerFormPhoto.php";
        break;

    case"stillPhotoForm":
        $controller = "Controllers/admin/gestionStillLife/Forms/controllerFormPhoto.php";
        break;

    case"fashPhotoForm":
        $controller = "Controllers/admin/gestionFashion/Forms/controllerFormPhoto.php";
        break;

    case"persoPhotoForm":
        $controller = "Controllers/admin/gestionPersonal/Forms/controllerFormPhoto.php";
        break;

    /********************** Delete Photos ***************************/
    case"selectPhotoDelete":
        $controller = "Models/selectedWork/gestionPhotos/delete.php";
        break;

    case"commPhotoDelete":
        $controller = "Models/commissioned/gestionPhotos/delete.php";
        break;

    case"stillPhotoDelete":
        $controller = "Models/stillLife/gestionPhotos/delete.php";
        break;

    case"fashPhotoDelete":
        $controller = "Models/fashion/gestionPhotos/delete.php";
        break;

    case"persoPhotoDelete":
        $controller = "Models/personal/gestionPhotos/delete.php";
        break;
}

if (!$controller) {
    http_response_code(404);
    require "Controllers/pages/Error404.php";
    die();
}

require $controller;