<?php
require_once ('dao/DaoPapier.php');
require_once ('dao/DaoPays.php');

$daoPapier = new DaoPapier();
$daoPapier->find($_GET["id"]);
$daoPapier->setLesPays();

$daoPays = new DaoPays();
$listePays = $daoPays->getListe();

if (isset($_POST["valider"])) {
    $daoPapier->bean->setNom($_POST["nom"]);
    $daoPapier->bean->setDescription($_POST["description"]);
    $daoPapier->bean->setDuree($_POST["duree"]);
    $daoPapier->update();

    header('Location: index.php?page=modifPapier&id='.$_GET['id']);

    if (($_SESSION['mail']) == '') {
        header('Location: index.php?page=accueil');

    } else {
        if ((($_SESSION['admin']) == "0")) {
            header('Location: index.php?page=Etudiant');
        }
    }
}

if (isset($_POST["creer"])) {

    $daoPays->find($_POST["pays"]);
    $daoPapier->addPays2($daoPays->bean);

    // redirection formulaire
    header('Location: index.php?page=modifPapier&id=' . $_GET["id"]);
}

if (isset($_POST["supp"])) {

    $daoPays->find($_POST["idPays"]);
    $daoPapier->delPays($daoPays->bean);

    header('Location: index.php?page=modifPapier&id=' . $_GET["id"]);
}

$param = array(
    "papier" => $daoPapier,
    "listePays" => $listePays
);

//echo "<pre>";
//print_r($param);
//echo "</pre>";