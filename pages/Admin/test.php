<?php
/**
 * Created by PhpStorm.
 * User: Joshua
 * Date: 05/12/2016
 * Time: 13:23
 */

require_once 'dao/DaoEntreprise.php';




$daoEntreprise = new DaoEntreprise();


$listeEntreprise = $daoEntreprise->getListe();


for ($i = 0; $i < count($listeEntreprise); $i++) {

    $daoEntreprise = new DaoEntreprise();

    $daoEntreprise->find($listeEntreprise[$i]->getId());

    $listeEntreprise[$i] = $daoEntreprise->bean;
}
$param = array(

    "liste" => $listeEntreprise
);

echo "<pre>";
print_r($param);
echo "</pre>";