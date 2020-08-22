<?php
session_start();
require "../../connectDataBase.php";
require "../../ModelsFonctions.php";

$_POST["titre"] = htmlspecialchars($_POST["titre"]);
$_POST["classement"] = htmlspecialchars($_POST["classement"]);

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

uploadSelectedPhotos("selectedWork");

if (isset($_POST["id"]))// UPDATE
{
    $query = $dbh->prepare("SELECT photo FROM selectedWork WHERE id = :id");
    $query->execute(
        [
            "id" => $_POST["id"],
        ]
    );

    $oldTitle = $query->fetch(PDO::FETCH_ASSOC);

    if ($_POST["titre"] == "")// si pas de titre saisi dans le formulaire
    {
        $_POST["titre"] = $oldTitle["photo"];
    }

    if (($_FILES["photo"]["name"] === "" && $_FILES["photo"]["size"] === 0) || !isset($_FILES["photo"])) //sans update de photo
    {
        $query = $dbh->prepare("UPDATE selectedWork SET titre = :titre, classement = :classement WHERE id = :id");
        $query->execute(
            [
                "titre" => $_POST["titre"],
                "classement" => $_POST["classement"],
                "id" => $_POST["id"],
            ]
        );
    }
} else {
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
        "INSERT INTO selectedWork (photo, titre, classement) Values (:photo, :titre, :classement)"
    ); //INSERTION
    $query->execute(
        [
            "photo" => $_FILES["photo"]["name"],
            "titre" => $_POST["titre"],
            "classement" => $_POST["classement"],
        ]
    );
}

$arr = array('error' => false);
echo(json_encode($arr));

return;
