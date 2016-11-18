<?php
require_once('dao/DaoPapier.php');

session_start();

if (isset($_POST["valider"])) {
    // Instanciation du Dao qui permettra la création
    $DaoPapier = new DaoPapier();
    // Chargement du nom sur le bean du dao
    $DaoPapier->bean->setNom($_POST['nom']);
    $DaoPapier->bean->setDescription($_POST['description']);
    $DaoPapier->bean->setConseil($_POST['conseil']);
    $DaoPapier->bean->setDuree($_POST['duree']);
    $DaoPapier->bean->setPays($_POST['pays']);

    $DaoPapier->create();
    header('Location: index.php?page=listePapier');
    exit();
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
);

?>