<?php
require_once('dao/DaoEntreprise.php');
require_once('dao/DaoPersonne.php');
require_once ('classes/class.Entreprise.php');

$daoEntreprise = new DaoEntreprise();
$daoPersonne = new DaoPersonne();


$daoEntreprise->find($_GET["id"]);
$daoEntreprise->setLePays();
$daoEntreprise->setLesTypes();

$param = array(
    "entreprise" => $daoEntreprise->bean
);
if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}