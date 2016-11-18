<?php

require_once 'dao/DaoPapier.php';
session_start();

$daoPapier = new DaoPapier();


$listePapier = $daoPapier->getListe();


for ($i = 0; $i < count($listePapier); $i++) {

    $daoPapier = new DaoPapier();

    $daoPapier->find($listePapier[$i]->getId());

    $listePapier[$i] = $daoPapier->bean;
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
    "liste" => $listePapier
);

?>






