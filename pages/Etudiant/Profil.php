<?php

require_once 'dao/DaoPersonne.php';
session_start();



if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

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
    "Admin2" => $affiche2
);

