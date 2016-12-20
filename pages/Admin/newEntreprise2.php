<?php

require_once('dao/DaoEntreprise.php');

$daoEntreprise = new DaoEntreprise();


$daoEntreprise->findByNomEnt($_GET["nom"]);


if (isset($_POST["valider"])) {
    // Instanciation du Dao qui permettra la création
    $DaoEntreprise = new DaoEntreprise();
    // Chargement du nom sur le bean du dao

    $id_ent = $daoEntreprise->bean->getId();
    $id_type = $_POST["type1"];

    $DaoEntreprise->addLesTypes($id_ent, $id_type);
    header('Location: index.php?page=listeEntreprise');
    exit();
}


$param = array(
    "nom" => $_GET["nom"],
    "entreprie" => $daoEntreprise


);


echo "<pre>";
print_r($param);
echo "</pre>";


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

} else {
    if ((($_SESSION['admin']) == "0")) {
        header('Location: index.php?page=Etudiant');
    }
}

?>