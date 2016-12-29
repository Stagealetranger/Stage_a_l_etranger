<?php

require_once('dao/DaoPapier.php');
require_once('dao/DaoPays.php');

$daoPays = New DaoPays();
$daoPapier = New DaoPapier();


$listePays = $daoPays->getListe();
for ($i = 0; $i < count($listePays); $i++) {
    $daoPays = new DaoPays();
    $daoPays->find($listePays[$i]->getId());
    $listePays[$i] = $daoPays->bean;
}

$daoPapier->findByNomPap($_GET['nom']);



if (isset($_POST["valider"])) {

    $id = $_POST['id'];
    if (!empty($_POST["pays1"])){
        $daoPapier->addPays($_POST['pays1'],$id);
    }
    if (!empty($_POST["pays2"])){
        $daoPapier->addPays($_POST['pays2'],$id);
    }
    if (!empty($_POST["pays3"])){
        $daoPapier->addPays($_POST['pays3'],$id);
    }
    if (!empty($_POST["pays4"])){
        $daoPapier->addPays($_POST['pays4'],$id);
    }
    if (!empty($_POST["pays4"])){
        $daoPapier->addPays($_POST['pays4'],$id);
    }
    if (!empty($_POST["pays5"])){
        $daoPapier->addPays($_POST['pays5'],$id);
    }
    if (!empty($_POST["pays6"])){
        $daoPapier->addPays($_POST['pays6'],$id);
    }
    if (!empty($_POST["pays7"])){
        $daoPapier->addPays($_POST['pays7'],$id);
    }
    if (!empty($_POST["pays8"])){
        $daoPapier->addPays($_POST['pays8'],$id);
    }
    if (!empty($_POST["pays9"])){
        $daoPapier->addPays($_POST['pays9'],$id);
    }
    header('Location: index.php?page=listePapier');
    exit();
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




