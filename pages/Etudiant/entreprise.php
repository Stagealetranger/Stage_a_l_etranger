<?php
require_once('dao/DaoEntreprise.php');
require_once('dao/DaoPersonne.php');
require_once ('classes/class.Entreprise.php');

$daoEntreprise = new DaoEntreprise();
$daoPersonne = new DaoPersonne();


$daoEntreprise->find($_GET["id"]);
$daoEntreprise->setLePays();
$daoEntreprise->setLesTypes();
$daoEntreprise->setAvis();


$param = array(
    "entreprise" => $daoEntreprise->bean
);

//echo "<pre>";
//print_r($param);
//echo "</pre>";


if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}