<?php

require_once('dao/DaoPays.php');

$dao = new DaoPays();


if (isset($_POST["valider"])) {

    
    $dao->bean->setNom($_POST['nom']);
    $dao->create();

    header('Location: index.php?page=listeEntreprise');
    exit();
}

if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}else{
    if ((($_SESSION['admin']) == "0")){
        header('Location: index.php?page=Etudiant');
    }

}