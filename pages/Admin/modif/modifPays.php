<?php
require_once 'dao/DaoPapier.php';
require_once 'dao/DaoPays.php';
require_once 'dao/DaoEntreprise.php';



$dao = new DaoPays();
$dao->find($_GET["id"]);
$dao->setLesPapiers();
$dao->setLesEntreprises();

if (isset($_POST["valider"])) {
    $dao->bean->setNom($_POST["nom"]);
    $dao->update();

    header('Location: index.php?page=modifPays&id='.$_GET['id']);

    if (($_SESSION['mail']) == '') {
        header('Location: index.php?page=accueil');

    } else {
        if ((($_SESSION['admin']) == "0")) {
            header('Location: index.php?page=Etudiant');
        }
    }
}



$param = array(
//    "liste" => $liste,
    "papier" => $dao
);