<?php

function deleteDirectory($dir) //supprime dossier
{
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir.DIRECTORY_SEPARATOR.$item)) {
            return false;
        }
    }

    return rmdir($dir);
}

function copyDirectory($src, $dst) //copie dossier
{

    $dir = opendir($src);  // ouvert le dossier

    @mkdir($dst);  // Vérifie si le dossier n'existe pas deja

    foreach (scandir($src) as $file)// parcourt le dossier lister les fichier
    {
        if (($file != '.') && ($file != '..'))// évite les dossier parents
        {
            if (is_dir($src.'/'.$file)) {
                copyDirectory(
                    $src.'/'.$file,
                    $dst.'/'.$file
                ); // appel récursif copyDirectory pour potentiel sous dossier
            } else {
                copy($src.'/'.$file, $dst.'/'.$file);  // copie les fichiers
            }
        }
    }
    closedir($dir); // ferme le dossier
}

function uploadPhotoCouv($pageName)// Vérifie si le fichier a été uploadé sans erreur.
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (strpos(
                htmlspecialchars($_POST["categorie"]),
                "/"
            ) == false)// recherche "/" dans le nom de la categorie pour éviter la création d'un sous dossier ou d'une balise fermante html
        {
            if (isset($_FILES["photoCouv"]) && $_FILES["photoCouv"]["error"] == 0) {
                $allowed = array(
                    "jpg" => "image/jpg",
                    "jpeg" => "image/jpeg",
                    "gif" => "image/gif",
                    "png" => "image/png",
                ); //tableau extension valide
                $filename = $_FILES["photoCouv"]["name"];
                $filetype = $_FILES["photoCouv"]["type"];
                $filesize = $_FILES["photoCouv"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION); //extension du fichier
                $maxsize = 5 * 1024 * 1024; // taille max a ne pas dépasser

                if (!array_key_exists($ext, $allowed)) //Si extension n'est pas trouvé dans le tab, fichier non valide
                {
                    die("Erreur : Veuillez sélectionner un format de fichier valide.");
                }

                if ($filesize > $maxsize) // Vérifie la taille du fichier - 5Mo maximum
                {
                    die("Error: La taille du fichier est supérieure à la limite autorisée.");
                }

                // Vérifie le type MIME du fichier
                if (in_array($filetype, $allowed)) {
                    // Vérifie si le fichier existe avant de le télécharger.
                    if (file_exists("../../../assets/images/".$pageName."/".$_POST["categorie"]."/".$filename)) {
                        die($filename." existe déjà.");
                    } else {
                        if (!is_dir(
                            "../../../assets/images/".$pageName."/".$_POST["categorie"]."/"
                        ))// Si le dossier n'existe pas
                        {
                            mkdir(
                                "../../../assets/images/".$pageName."/".$_POST["categorie"]."/",
                                0777,
                                true
                            ); // création dossier
                        }

                        move_uploaded_file(
                            $_FILES["photoCouv"]["tmp_name"],
                            "../../../assets/images/".$pageName."/".$_POST["categorie"]."/".$filename
                        ); // ajout de la photo de couverture dans le dossier

                        echo "Votre fichier a été téléchargé avec succès.";
                    }
                } else {
                    echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
                }
            } else {
                echo "Error: ".$_FILES["photoCouv"]["error"];
            }
        }
    }
}

function uploadPhotos($pageName, $categorie)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $allowed = array(
                "jpg" => "image/jpg",
                "jpeg" => "image/jpeg",
                "gif" => "image/gif",
                "png" => "image/png",
            ); //tableau extension valide
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION); //extension du fichier
            $maxsize = 5 * 1024 * 1024; // taille max a ne pas dépasser

            if (!array_key_exists($ext, $allowed)) //Si extension n'est pas trouvé dans le tab, fichier non valide
            {
                die("Erreur : Veuillez sélectionner un format de fichier valide.");
            }

            if ($filesize > $maxsize) // Vérifie la taille du fichier - 5Mo maximum
            {
                die("Error: La taille du fichier est supérieure à la limite autorisée.");
            }

            var_dump($_FILES["photo"]);

            // Vérifie le type MIME du fichier
            if (in_array($filetype, $allowed)) {
                // Vérifie si le fichier existe avant de le télécharger.
                if (file_exists("../../../assets/images/".$pageName."/".$categorie."/".$filename)) {
                    die ($filename." existe déjà.");
                } else {
                    move_uploaded_file(
                        $_FILES["photo"]["tmp_name"],
                        "../../../assets/images/".$pageName."/".$categorie."/".$filename
                    ); // ajout de la photo dans le dossier
                    echo("Votre fichier a été téléchargé avec succès.");
                }
            } else {
                echo("Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.");
            }
        } else {
            echo("Error: ".$_FILES["photo"]["error"]);
        }
    }
}

function uploadSelectedPhotos($pageName)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $allowed = array(
                "jpg" => "image/jpg",
                "jpeg" => "image/jpeg",
                "gif" => "image/gif",
                "png" => "image/png",
            ); //tableau extension valide
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION); //extension du fichier
            $maxsize = 5 * 1024 * 1024; // taille max a ne pas dépasser

            if (!array_key_exists($ext, $allowed)) //Si extension n'est pas trouvé dans le tab, fichier non valide
            {
                die("Erreur : Veuillez sélectionner un format de fichier valide.");
            }

            if ($filesize > $maxsize) // Vérifie la taille du fichier - 5Mo maximum
            {
                die("Error: La taille du fichier est supérieure à la limite autorisée.");
            }

            // Vérifie le type MIME du fichier
            if (in_array($filetype, $allowed)) {
                // Vérifie si le fichier existe avant de le télécharger.
                if (file_exists("../../../assets/images/".$pageName."/".$filename)) {
                    die($filename." existe déjà.");
                } else {
                    move_uploaded_file(
                        $_FILES["photo"]["tmp_name"],
                        "../../../assets/images/".$pageName."/".$filename
                    ); // ajout de la photo de couverture dans le dossier
                    echo "Votre fichier a été téléchargé avec succès.";
                }
            } else {
                echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
            }
        } else {
            echo "Error: ".$_FILES["photo"]["error"];
        }
    }
}
