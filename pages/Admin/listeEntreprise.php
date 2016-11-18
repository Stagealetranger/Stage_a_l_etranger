<?php

require_once 'dao/DaoEntreprise.php';

session_start();


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


if ($_SESSION['admin'] == 1){
    $affiche = "index.php?page=pageAdmin";
    $affiche2 = "Administrateur";

}

else{
    $affiche = " ";
    $affiche2 = " ";
}


$param = array(
    "session" => $_SESSION,
    "Admin" => $affiche,
    "Admin2" => $affiche2,
    "liste" => $listeEntreprise
);

?>