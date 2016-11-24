<?php
require_once('dao/DaoEntreprise.php');




if (isset($_POST["valider"])) {
    // Instanciation du Dao qui permettra la création
    $DaoEntreprise = new DaoEntreprise();
    // Chargement du nom sur le bean du dao
    $DaoEntreprise->bean->setNom($_POST['nom']);
    $DaoEntreprise->bean->setVisiter($_POST['visiter']);
    $DaoEntreprise->bean->setDescription($_POST['description']);
    $DaoEntreprise->bean->setRue($_POST['rue']);
    $DaoEntreprise->bean->setVille($_POST['ville']);
    $DaoEntreprise->bean->setDescriptionAvis($_POST['descritpionAvis']);
    $DaoEntreprise->bean->setAvis($_POST['avis']);
    $DaoEntreprise->bean->setTaille($_POST['taille']);
    $DaoEntreprise->bean->setProfil($_POST['profil']);
    $DaoEntreprise->bean->setPays($_POST['pays']);
    $DaoEntreprise->bean->setlesTypes($_POST['type']);

    $DaoEntreprise->create();
    header('Location: index.php?page=listeEntreprise');
    exit();
}


if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}else{
    if ((($_SESSION['admin']) == "0")){
        header('Location: index.php?page=Etudiant');
    }

}


$param = array(
   
   
);

?>