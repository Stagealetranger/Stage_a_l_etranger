<?php
require_once('dao/DaoValidation.php');



if ($_SESSION != ''){
    session_unset();
}

if (isset($_POST["valider"])) {
    // Instanciation du Dao qui permettra la création
    $DaoValidation = new DaoValidation();
    // Chargement du nom sur le bean du dao
    $DaoValidation->bean->setNom($_POST['nom']);
    $DaoValidation->bean->setPrenom($_POST['prenom']);
    $DaoValidation->bean->setMail($_POST['mail']);
    $DaoValidation->bean->setMdp(sha1($_POST['mdp']));


    $DaoValidation->create();
    header('Location: index.php?page=accueil');
    exit();
}




?>