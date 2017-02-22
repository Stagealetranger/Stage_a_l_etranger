<?php

require_once('dao/DaoEntreprise.php');
require_once('dao/DaoType.php');


$daoEntreprise = new DaoEntreprise();

    $daoEntreprise->findByNom($_GET["nom"]);

$daoEntreprise->setLesTypes();



$daoType = new DaoType();
$listeType = $daoType->getListe();
if(sizeof($daoEntreprise->bean->getLesTypes()) != 0) {
    $listeTypeEnt = $daoEntreprise->bean->getLesTypes();

    for ($i = 0; $i < count($listeType); $i++) {
        $trouve = false;
        for ($j = 0; $j < count($listeTypeEnt); $j++) {
            if ($listeType[$i]->getId() == $listeTypeEnt[$j]->getId()) {
                $trouve = true;
            }
        }
        if (!$trouve) {
            $listeTemp[] = $listeType[$i];
        }
    }
    $listeType = $listeTemp;
}



if (isset($_POST["valider"])) {
    header('Location: index.php?page=listeEntreprise');
    exit();
}


if (isset($_POST["creer"])) {
    $daoType->find($_POST["type"]);

    $daoEntreprise->addType2($daoType->bean);

    // redirection formulaire
    header('Location: index.php?page=newEntreprise2&nom='.$_GET["nom"]);
}

if (isset($_POST["supp"])) {
    $daoType->find($_POST["idType"]);

    $daoEntreprise->delType($daoType->bean);

    header('Location: index.php?page=newEntreprise2&nom='.$_GET["nom"]);
}


$param = array(
    "liste" => $listeType,
    "nom" => $_GET["nom"],
    "entreprise" => $daoEntreprise,

);


//echo "<pre>";
//print_r($param);
//echo "</pre>";

if (($_GET["nom"]) == '') {
    header('Location: index.php?page=newPapier');

}

if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

} else {
    if ((($_SESSION['admin']) == "0")) {
        header('Location: index.php?page=Etudiant');
    }
}

?>