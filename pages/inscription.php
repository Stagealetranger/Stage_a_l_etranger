<?php
require_once('dao/DaoPersonne.php');



if ($_SESSION != ''){
    session_unset();
}

if (isset($_POST["valider"])) {
    // Instanciation du Dao qui permettra la création
    $DaoPersonne = new DaoPersonne();
    // Chargement du nom sur le bean du dao
    $DaoPersonne->bean->setNom($_POST['nom']);
    $DaoPersonne->bean->setPrenom($_POST['prenom']);
    $DaoPersonne->bean->setMail($_POST['mail']);
    $DaoPersonne->bean->setMdp(sha1($_POST['mdp']));


    $DaoPersonne->create();
    header('Location: index.php?page=accueil');
    exit();
}




?>