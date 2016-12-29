<?php

require_once('dao/DaoEntreprise.php');
require_once('dao/DaoType.php');


$daoEntreprise = new DaoEntreprise();
$daoType = new DaoType();

$daoEntreprise->findByNom($_GET["nom"]);

if (isset($_POST["valider"])) {

$id = $_POST['id'];
   if (!empty($_POST["type1"])){
        $daoType->find($_POST["type1"]);

       $daoEntreprise->addTypes($daoType->bean,$id);
    }
   if (!empty($_POST["type2"])){
        $daoType->find($_POST["type2"]);

       $daoEntreprise->addTypes($daoType->bean,$id);
    }
    if (!empty($_POST["type3"])){
        $daoType->find($_POST["type3"]);

        $daoEntreprise->addTypes($daoType->bean,$id);
    }

    header('Location: index.php?page=listeEntreprise');
    exit();
}


$param = array(
    "nom" => $_GET["nom"],
    "entreprise" => $daoEntreprise
);


//echo "<pre>";
//print_r($param);
//echo "</pre>";

if (($_GET["nom"]) == '') {
    header('Location: index.php?page=newPapier');

}

if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

} else {
    if ((($_SESSION['admin']) == "0")) {
        header('Location: index.php?page=Etudiant');
    }
}

?>