<?php

require_once('dao/DaoEntreprise.php');
require_once('dao/DaoType.php');


$daoEntreprise = new DaoEntreprise();
$daoType = new DaoType();

$daoEntreprise->findByNomEnt($_GET["nom"]);

if (isset($_POST["valider"])) {
    
    if ($_POST["type1"] != ""){
        $daoType->find($_POST["type1"]);
        $daoEntreprise->addTypes($daoType->bean);
    }

    if ($_POST["type2"] != ""){
        $daoType->find($_POST["type2"]);
        $daoEntreprise->addTypes($daoType->bean);
    }

    if ($_POST["type3"] != ""){
        $daoType->find($_POST["type3"]);
        $daoEntreprise->addTypes($daoType->bean);
    }

    
    
    
    header('Location: index.php?page=listeEntreprise');
    exit();
}


$param = array(
    "nom" => $_GET["nom"],
    "entreprie" => $daoEntreprise
);


echo "<pre>";
print_r($param);
echo "</pre>";


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

} else {
    if ((($_SESSION['admin']) == "0")) {
        header('Location: index.php?page=Etudiant');
    }
}

?>