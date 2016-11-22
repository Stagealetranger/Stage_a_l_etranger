<?php

require_once 'dao/DaoEntreprise.php';




$daoEntreprise = new DaoEntreprise();


$listeEntreprise = $daoEntreprise->getListe();


for ($i = 0; $i < count($listeEntreprise); $i++) {

    $daoEntreprise = new DaoEntreprise();

    $daoEntreprise->find($listeEntreprise[$i]->getId());

    $listeEntreprise[$i] = $daoEntreprise->bean;
}



if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}else{
    if ((($_SESSION['admin']) == "0")){
        header('Location: index.php?page=Etudiant');
    }

}



$param = array(
    "session" => $_SESSION,
    "liste" => $listeEntreprise
);

?>