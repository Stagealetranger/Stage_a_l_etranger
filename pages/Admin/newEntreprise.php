<?php
require_once('dao/DaoEntreprise.php');
require_once('dao/DaoPays.php');


$daoPays = New DaoPays();


$listePays = $daoPays->getListe();
for ($i = 0; $i < count($listePays); $i++) {
    $daoPays = new DaoPays();
    $daoPays->find($listePays[$i]->getId());
    $listePays[$i] = $daoPays->bean;
}




if (isset($_POST["valider"])) {
    // Instanciation du Dao qui permettra la création
    $DaoEntreprise = new DaoEntreprise();
    // Chargement du nom sur le bean du dao
    $DaoEntreprise->bean->setNom($_POST['nom']);
    $DaoEntreprise->bean->setVisiter($_POST['visiter']);
    $DaoEntreprise->bean->setDescription($_POST['description']);
    $DaoEntreprise->bean->setRue($_POST['rue']);
    $DaoEntreprise->bean->setVille($_POST['ville']);
    $DaoEntreprise->bean->setAvis($_POST['avis']);
    $DaoEntreprise->bean->setTaille($_POST['taille']);
    $DaoEntreprise->bean->setContact($_POST['contact']);
    $DaoEntreprise->bean->setLePays($_POST['pays']);
    $DaoEntreprise->bean->setTelephone($_POST['telephone']);
    $DaoEntreprise->bean->setLongitude(4);
    $DaoEntreprise->bean->setLatitude(3);

  

    $DaoEntreprise->create();
    header('Location: index.php?page=newEntreprise2&nom='.$_POST["nom"]);
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
    "liste" => $listePays
);



?>