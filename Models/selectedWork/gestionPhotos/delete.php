<?php
session_start();

require "Models/connectDataBase.php";
require "Models/ModelsFonctions.php";

if (isset($_GET["id"])) {
    $query = $dbh->prepare("SELECT photo FROM selectedWork WHERE id = :id");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
    $deletePhoto = $query->fetch(PDO::FETCH_ASSOC);

    unlink("assets/images/selectedWork/".$deletePhoto["photo"]);

    $query = $dbh->prepare("DELETE FROM selectedWork WHERE id = :id ");
    $query->execute(
        [
            "id" => $_GET["id"],
        ]
    );
}

header('Location: selectPhoto');
exit();
