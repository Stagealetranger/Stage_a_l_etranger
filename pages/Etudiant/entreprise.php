<?php
require_once('dao/DaoEntreprise.php');
require_once('dao/DaoPersonne.php');


$daoEntreprise = new DaoEntreprise();
$daoPersonne = new DaoPersonne();


$daoEntreprise->find($_GET["id"]);

$param = array(
    "entreprise" => $daoEntreprise
);
if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}


?>