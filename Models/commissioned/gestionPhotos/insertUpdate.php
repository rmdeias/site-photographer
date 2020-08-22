<?php
session_start();

require "../../connectDataBase.php";
require "../../ModelsFonctions.php";

$_POST["titre"] = htmlspecialchars($_POST["titre"]);
$_POST["classement"] = htmlspecialchars($_POST["classement"]);

if ($_POST["categories"] === "") {
    $arr = array('error' => true, 'msg' => "categorie invalide");
    echo(json_encode($arr));

    return;
}

if ($_POST["classement"] == "")// si pas de classement saisi dans le formulaire
{
    $_POST["classement"] = 99;
}

if ((is_nan(
            $_POST["classement"]
        ) || ($_POST["classement"] <= 0 || $_POST["classement"] >= 100)) && ($_POST["classement"] !== ""))// si la valeur saisie n'est pas un nombre compris entre 1 et 99
{
    $arr = array('error' => true, 'msg' => "Nombre invalide");
    echo(json_encode($arr));

    return;
}

$query = $dbh->prepare("SELECT categorie FROM categorie_Commissioned where id = :categories");
$query->execute(
    [
        "categories" => $_POST["categories"],
    ]
);
$photoCat = $query->fetch(
    PDO::FETCH_ASSOC
);// récupére la categorie pour l'inserer dans le chemin  de l'upload de la photo

uploadPhotos("commissioned", $photoCat["categorie"]);

if (isset($_POST["id"]))// UPDATE
{
    $query = $dbh->prepare(
        "SELECT categorie, photo FROM commissioned INNER JOIN categorie_Commissioned ON commissioned.id_Categorie = categorie_Commissioned.id WHERE commissioned.id = :id"
    );
    $query->execute(
        [
            "id" => $_POST["id"],
        ]
    );

    $oldCat = $query->fetch(PDO::FETCH_ASSOC); // ancienne categorie de la photo

    if ($_POST["titre"] == "")// si pas de titre saisi dans le formulaire
    {
        $_POST["titre"] = $oldCat["photo"];
    }

    if (($_FILES["photo"]["name"] === "" && $_FILES["photo"]["size"] === 0) || !isset($_FILES["photo"])) //sans update de photo
    {
        $query = $dbh->prepare(
            "UPDATE commissioned INNER JOIN categorie_Commissioned ON commissioned.id_Categorie = categorie_Commissioned.id SET titre = :titre, classement = :classement, id_Categorie = :id_Categorie WHERE commissioned.id = :id"
        );
        $query->execute(
            [
                "id_Categorie" => $_POST["categories"],
                "titre" => $_POST["titre"],
                "classement" => $_POST["classement"],
                "id" => $_POST["id"],
            ]
        );
    }

    $query = $dbh->prepare(
        "SELECT categorie, photo FROM commissioned INNER JOIN categorie_Commissioned ON commissioned.id_Categorie = categorie_Commissioned.id WHERE commissioned.id = :id"
    );
    $query->execute(
        [
            "id" => $_POST["id"],
        ]
    );
    $newCat = $query->fetch(PDO::FETCH_ASSOC); // nouvelle categorie de la photo + nom de la photo

    if ($oldCat["categorie"] != $newCat["categorie"]) {
        copy(
            "../../../assets/images/commissioned/".$oldCat["categorie"]."/".$newCat["photo"],
            "../../../assets/images/commissioned/".$newCat["categorie"]."/".$newCat["photo"]
        );//copie la photo dans le nouveau dossier
        unlink(
            "../../../assets/images/commissioned/".$oldCat["categorie"]."/".$newCat["photo"]
        ); //supprime la photo de l'ancien dossier
    }
} else//INSERT
{
    if ($_FILES["photo"]["name"] === "" && $_FILES["photo"]["size"] === 0) {
        $arr = array('error' => true, 'msg' => "photo invalide");
        echo(json_encode($arr));

        return;
    }

    if ($_POST["titre"] == "")// si pas de titre saisi dans le formulaire
    {
        $_POST["titre"] = $_FILES["photo"]["name"];
    }

    $query = $dbh->prepare(
        "INSERT INTO commissioned (id_Categorie,photo,titre,classement) Values (:id_Categorie, :photo, :titre, :classement)"
    );
    $query->execute(
        [
            "id_Categorie" => $_POST["categories"],
            "photo" => $_FILES["photo"]["name"],
            "titre" => $_POST["titre"],
            "classement" => $_POST["classement"],
        ]
    );
}

$arr = array('error' => false);
echo(json_encode($arr));

return;
