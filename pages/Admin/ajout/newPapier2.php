<?php

require_once('dao/DaoPapier.php');
require_once('dao/DaoPays.php');


$daoPapier = New DaoPapier();
$daoPapier->findByNomPap($_GET['nom']);
$daoPapier->setLesPays();

$daoPays = new DaoPays();
$listePays = $daoPays->getListe();
if(sizeof($daoPapier->bean->getLesPays()) != 0) {
    $listePaysPapier = $daoPapier->bean->getLesPays();

    for ($i = 0; $i < count($listePays); $i++) {
        $trouve = false;
        for ($j = 0; $j < count($listePaysPapier); $j++) {
            if ($listePays[$i]->getId() == $listePaysPapier[$j]->getId()) {
                $trouve = true;
            }
        }
        if (!$trouve) {
            $listeTemp[] = $listePays[$i];
        }
    }
    $listePays = $listeTemp;

}



if (isset($_POST["creer"])) {

    $daoPays->find($_POST["pays"]);
    $daoPapier->addPays2($daoPays->bean);

    // redirection formulaire
    header('Location: index.php?page=newPapier2&nom='.$_GET["nom"]);
}

if (isset($_POST["supp"])) {

    $daoPays->find($_POST["idPays"]);
    $daoPapier->delPays($daoPays->bean);

    header('Location: index.php?page=newPapier2&nom=' . $_GET["nom"]);
}



$param = array(
    "nom" => $_GET["nom"],
    "papier" => $daoPapier,
     "liste" => $listePays
);

//
//echo "<pre>";
//print_r($param);
//echo "</pre>";

if (($_GET["nom"]) == '') {
    header('Location: index.php?page=newEntreprise');

}


if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}else{
    if ((($_SESSION['admin']) == "0")){
        header('Location: index.php?page=Etudiant');
    }

}




