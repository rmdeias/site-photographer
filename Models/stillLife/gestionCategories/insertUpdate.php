<?php
session_start();

require "../../connectDataBase.php";
require "../../ModelsFonctions.php";

uploadPhotoCouv("stillLife");

$_POST["categorie"] = htmlspecialchars($_POST["categorie"]);//evite faille xss

if (strlen($_POST["categorie"]) === 0) {
    $arr = array('error' => true, 'msg' => "titre invalide");
    echo(json_encode($arr));

    return;
}

if (strpos(
        $_POST["categorie"],
        "/"
    ) == false)/// évite d'envoyer a la base de donné des dossiers(categorie) et des fichier(photo) non créé par uploadPhotoCouv()
{
    if (isset($_POST["id"])) // UPDATE
    {
        $query = $dbh->prepare("SELECT photoCouv,categorie FROM categorie_StillLife WHERE id = :id");
        $query->execute(
            [
                "id" => $_POST["id"],
            ]
        );
        $cat = $query->fetch(PDO::FETCH_ASSOC);

        if (($_FILES["photoCouv"]["name"] === "" && $_FILES["photoCouv"]["size"] === 0) || !isset($_FILES["photoCouv"])) //sans update de photoCouv
        {
            $query = $dbh->prepare("UPDATE categorie_StillLife SET categorie = :categorie WHERE id = :id");
            $query->execute(
                [
                    "id" => $_POST["id"],
                    "categorie" => $_POST["categorie"],
                ]
            );
            rename(
                "../../../assets/images/stillLife/".$cat["categorie"],
                "../../../assets/images/stillLife/".$_POST["categorie"]
            ); //renomme le dossier
        } else {
            $query = $dbh->prepare(
                "UPDATE categorie_StillLife SET categorie = :categorie,photoCouv =:photoCouv WHERE id = :id"
            );
            $query->execute(
                [
                    "id" => $_POST["id"],
                    "categorie" => $_POST["categorie"],
                    "photoCouv" => $_FILES["photoCouv"]["name"],
                ]
            );

            unlink(
                "../../../assets/images/stillLife/".$cat["categorie"]."/".$cat["photoCouv"]
            ); //supprime ancienne photoCouv

            if ($cat["categorie"] != $_POST["categorie"]) {
                copyDirectory(
                    "../../../assets/images/stillLife/".$cat["categorie"],
                    "../../../assets/images/stillLife/".$_POST["categorie"]
                ); //copie dossier
                deleteDirectory("../../../assets/images/stillLife/".$cat["categorie"]); //suprimme l'ancien dossier
            }
        }
    } else // INSERT
    {
        if ($_FILES["photoCouv"]["name"] === "" && $_FILES["photoCouv"]["size"] === 0) {
            $arr = array('error' => true, 'msg' => "photo invalide");
            echo(json_encode($arr));

            return;
        }

        $query = $dbh->prepare(
            "INSERT INTO categorie_StillLife (categorie, photoCouv) Values (:categorie, :photoCouv)"
        );
        $query->execute(
            [
                "categorie" => $_POST["categorie"],
                "photoCouv" => $_FILES["photoCouv"]["name"],
            ]
        );
    }
}

$arr = array('error' => false);
echo(json_encode($arr));

return;
