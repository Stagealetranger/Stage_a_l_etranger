<?php

require_once 'dao/DaoEntreprise.php';
require_once 'dao/DaoType.php';


$daoEntreprise = new DaoEntreprise();
$daoType = new DaoType();


$recherche = array(
    'communication' => $_GET['communication'],
    'graphisme' => $_GET['graphisme'],
    'developpement' => $_GET['developpement'],
    'GE' => $_GET['GE'],
    'PME' => $_GET['PME'],
    'connu' => $_GET['connu'],
    'inconnu' => $_GET['inconnu'],
    'aimer' => $_GET['aimer']

);


$graphisme = $_GET['graphisme'];

$listeEntreprise = $daoEntreprise->getListe();
for ($i = 0; $i < count($listeEntreprise); $i++) {

    $daoEntreprise = new DaoEntreprise();

    $daoEntreprise->find($listeEntreprise[$i]->getId());

    $daoEntreprise->setLesTypes();


    $listeEntreprise[$i] = $daoEntreprise->bean;


}
$param = array(
    "recherche" => $recherche,
    "session" => $_SESSION,
    "liste" => $listeEntreprise
);


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

}


?>


