<?php

require_once('dao/DaoEntreprise.php');
require_once('dao/DaoPersonne.php');



$daoEntreprise = new DaoEntreprise();
$daoPersonne = new DaoPersonne();

$daoEntreprise->find($_GET['id']);
$listePersonne = $daoPersonne ->getListe();
for ($i = 0; $i < count($listePersonne); $i++) {
    $daoPersonne = new DaoPersonne();
    $daoPersonne->find($listePersonne[$i]->getId());
    $listePersonne[$i] = $daoPersonne->bean;
}




if (isset($_POST["valider"])) {

    $id = $_GET['id'];
    $personne = $_POST['personne'];
    $avis = $_POST['avis'];
    $daoEntreprise->addAvis($personne,$id,$avis);
    
    header('Location: index.php?page=listeEntreprise');
    exit();
}


$param = array(
    "entreprise" => $daoEntreprise,
    "listePersonnes" => $listePersonne
);


//echo "<pre>";
//print_r($param);
//echo "</pre>";


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

} else {
    if ((($_SESSION['admin']) == "0")) {
        header('Location: index.php?page=Etudiant');
    }
}

?>