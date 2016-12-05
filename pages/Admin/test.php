<?php
/**
 * Created by PhpStorm.
 * User: Joshua
 * Date: 05/12/2016
 * Time: 13:23
 */
/*
require_once 'dao/DaoEntreprise.php';




$daoEntreprise = new DaoEntreprise();


$listeEntreprise = $daoEntreprise->getListe();


for ($i = 0; $i < count($listeEntreprise); $i++) {

    $daoEntreprise = new DaoEntreprise();
    $daoEntreprise->find($listeEntreprise[$i]->getId());
$daoEntreprise ->setLesPersonnesVont();
    $listeEntreprise[$i] = $daoEntreprise->bean;
}
$param = array(

    "liste" => $listeEntreprise
);
*/
require_once 'dao/DaoValidation.php';
require_once 'dao/DaoPersonne.php';


$daoPersonne = new DaoPersonne();


$listePersonne = $daoPersonne ->getListePersonne();


for ($i = 0; $i < count($listePersonne); $i++) {

    $daoPersonne = new DaoPersonne();

    $daoPersonne->find($listePersonne[$i]->getId());
    $daoPersonne ->setLesEntreprisesAccueil();

    $listePersonne[$i] = $daoPersonne->bean;
}
$param = array(

    "liste" => $listePersonne
);

echo "<pre>";
print_r($param);
echo "</pre>";