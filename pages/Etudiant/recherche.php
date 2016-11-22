<?php

require_once 'dao/DaoEntreprise.php';
require_once 'dao/DaoType.php';



$daoEntreprise = new DaoEntreprise();
$daoType = new DaoType();


$listeEntreprise = $daoEntreprise->getListe();
for ($i = 0; $i < count($listeEntreprise); $i++) {

    $daoEntreprise = new DaoEntreprise();

    $daoEntreprise->find($listeEntreprise[$i]->getId());

    $daoEntreprise->setLesTypes();


    $listeEntreprise[$i] = $daoEntreprise->bean;

    
}
$param = array(
    "liste" => $listeEntreprise
);


echo "<pre>";
print_r($param);
echo "</pre>";



if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}
?>


