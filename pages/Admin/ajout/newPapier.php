<?php
require_once('dao/DaoPapier.php');





if (isset($_POST["valider"])) {
    // Instanciation du Dao qui permettra la création
    $DaoPapier = new DaoPapier();
    // Chargement du nom sur le bean du dao
    $DaoPapier->bean->setNom($_POST['nom']);
    $DaoPapier->bean->setDescription($_POST['description']);
    $DaoPapier->bean->setDuree($_POST['duree']);
    $DaoPapier->create();
    header('Location: index.php?page=newPapier2&nom='.$_POST['nom']);
    exit();
}





?>