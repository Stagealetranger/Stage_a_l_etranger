<?php
require_once 'dao/DaoPapier.php';
require_once 'dao/DaoPays.php';



$dao = new DaoPapier();
$dao->find($_GET["id"]);
$dao->setLesPays();

//$daoPays = new DaoPays();
//$liste = $daoPays->getListe();


if (isset($_POST["valider"])) {
    $dao->bean->setNom($_POST["nom"]);
    $dao->bean->setDescription($_POST["description"]);
    $dao->bean->setDuree($_POST["duree"]);
    $dao->update();

    header('Location: index.php?page=modifPapier&id='.$_GET['id']);

    if (($_SESSION['mail']) == '') {
        header('Location: index.php?page=accueil');

    } else {
        if ((($_SESSION['admin']) == "0")) {
            header('Location: index.php?page=Etudiant');
        }
    }
}



$param = array(
//    "liste" => $liste,
    "papier" => $dao
);

echo "<pre>";
print_r($param);
echo "</pre>";