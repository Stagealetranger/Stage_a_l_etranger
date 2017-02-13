<?php
require_once 'dao/DaoEntreprise.php';
require_once 'dao/DaoPays.php';



$dao = new DaoEntreprise();
$dao->find($_GET["id"]);
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
    $dao->bean->setVille($_POST["ville"]);
    $dao->bean->setContact($_POST["contact"]);
    $dao->bean->setTelephone($_POST["telephone"]);
    $daoPays->find($_POST["pays"]);
    $dao->bean->setLePays($_POST["pays"]);
    $dao->update();
    
    header('Location: index.php?page=modifEnt&id='.$_GET['id']);

    if (($_SESSION['mail']) == '') {
        header('Location: index.php?page=accueil');

    } else {
        if ((($_SESSION['admin']) == "0")) {
            header('Location: index.php?page=Etudiant');
        }
    }
}



$param = array(
    "liste" => $liste,
    "entreprise" => $dao
);

//echo "<pre>";
//print_r($param);
//echo "</pre>";