<?php
require_once 'dao/DaoEntreprise.php';
require_once 'dao/DaoPays.php';
require_once 'dao/DaoType.php';



$daoEntreprise = new DaoEntreprise();
$daoEntreprise->find($_GET["id"]);
$daoEntreprise->setLePays();
$daoEntreprise->setLesTypes();

$daoPays = new DaoPays();
$liste = $daoPays->getListe();

$daoType = new DaoType();
$listeType = $daoType->getListe();


if (isset($_POST["valider"])) {
    $daoEntreprise->bean->setNom($_POST["nom"]);
    $daoEntreprise->bean->setVisiter($_POST["visiter"]);
    $daoEntreprise->bean->setDescription($_POST["description"]);
    $daoEntreprise->bean->setRue($_POST["rue"]);
    $daoEntreprise->bean->setAvis($_POST["avis"]);
    $daoEntreprise->bean->setTaille($_POST["taille"]);
    $daoEntreprise->bean->setVille($_POST["ville"]);
    $daoEntreprise->bean->setContact($_POST["contact"]);
    $daoEntreprise->bean->setTelephone($_POST["telephone"]);
    $daoPays->find($_POST["pays"]);
    $daoEntreprise->bean->setLePays($_POST["pays"]);
    $daoEntreprise->update();
    
    header('Location: index.php?page=modifEnt&id='.$_GET['id']);

    if (($_SESSION['mail']) == '') {
        header('Location: index.php?page=accueil');

    } else {
        if ((($_SESSION['admin']) == "0")) {
            header('Location: index.php?page=Etudiant');
        }
    }

    if (isset($_POST["creer"])) {

        $daoType->find($_POST["type"]);

        $daoEntreprise->addType2($daoType->bean);
        
        // redirection formulaire
        header('Location: index.php?page=modifPapier&id=' . $_GET["id"]);
    }
        
        if (isset($_POST["supp"])) {

            $daoType->find($_POST["idType"]);

            $daoEntreprise->delType($daoType->bean);

            header('Location: index.php?page=modifEnt&id=' . $_GET["id"]);
        }

    
}



$param = array(
    "liste" => $liste,
    "listeType" => $listeType,
    "entreprise" => $daoEntreprise
);

//echo "<pre>";
//print_r($param);
//echo "</pre>";