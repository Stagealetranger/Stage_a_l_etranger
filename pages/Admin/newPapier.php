<?php
require_once('dao/DaoPapier.php');



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




$param = array(
   
  
);

?>