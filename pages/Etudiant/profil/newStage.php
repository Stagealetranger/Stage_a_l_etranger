<?php
require_once 'dao/DaoSuivit.php';
require_once 'dao/DaoPays.php';



$dao = new DaoSuivit();
$dao->find($_SESSION["id_suivit"]);
$daoPays = new DaoPays();
$liste = $daoPays->getListe();



if (isset($_POST["valider"])) {
    $dao->bean->setNom($_POST["nom"]);
    $dao->bean->setLePays($_POST["pays"]);
    $dao->update();

    header('Location: index.php?page=Profil');

    if (($_SESSION['mail']) == '') {
        header('Location: index.php?page=accueil');

    }
}



$param = array(
    "liste" => $liste,
    "papier" => $dao
);

//echo "<pre>";
//print_r($param);
//echo "</pre>";