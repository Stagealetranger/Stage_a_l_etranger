<?php
require_once 'dao/DaoEntreprise.php';
require_once 'dao/DaoPays.php';
require_once 'dao/DaoPersonne.php';


$dao = new DaoEntreprise();
$dao->find($_SESSION["id"]);
$dao->setLePays();

$daoPays = new DaoPays();
$liste = $daoPays->getListe();


if (isset($_POST["valider"])) {
    $dao->bean->setNom($_POST["nom"]);
    $dao->bean->setVisiter($_POST["visiter"]);
    $dao->bean->setDescription($_POST["description"]);
    $dao->bean->setRue($_POST["rue"]);
    $dao->bean->setAvis($_POST["avis"]);
    $dao->bean->setTaille($_POST["taille"]);
    $dao->bean->setProfil($_POST["profil"]);
    $dao->bean->setVille($_POST["ville"]);
    $dao->bean->setContact($_POST["contact"]);
    $dao->bean->setTelephone($_POST["telephone"]);
    $dao->update();
    header('Location: index.php?page=modifEnt');

    if (($_SESSION['mail']) == '') {
        header('Location: index.php?page=accueil');

    } else {
        if ((($_SESSION['admin']) == "0")) {
            header('Location: index.php?page=Etudiant');
        }
    }
}