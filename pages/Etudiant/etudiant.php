<?php
require_once('dao/DaoPays.php');
require_once('dao/DaoEntreprise.php');

$communication = "";
$graphisme = "";
$developpement = "";
$connu = "";
$inconnu = "";
$PME = "";
$GE = "";
$aimer = "";
$ville = "";
$pays = "";

$daoPays = New DaoPays();


$listePays = $daoPays->getListe();
for ($i = 0; $i < count($listePays); $i++) {
    $daoPays = new DaoPays();
    $daoPays->find($listePays[$i]->getId());
    $listePays[$i] = $daoPays->bean;
}

$daoEntreprise = New DaoEntreprise();

$listeEntreprise = $daoEntreprise->getListe();
for ($i = 0; $i < count($listeEntreprise); $i++) {
    $daoEntreprise = new DaoEntreprise();
    $daoEntreprise->find($listeEntreprise[$i]->getId());
    $listeEntreprise[$i] = $daoEntreprise->bean;
}


if (isset($_POST["recherche"])) {
    if ($_POST['communication'] == "") {
        $communication = "0";
    } else {
        $communication = $_POST['communication'];
    }
    if ($_POST['graphisme'] == "") {
        $graphisme = "0";
    } else {
        $graphisme = $_POST['graphisme'];
    }
    if ($_POST['developpement'] == "") {
        $developpement = "0";
    } else {
        $developpement = $_POST['developpement'];
    }
    if ($_POST['GE'] == "") {
        $GE = "0";
    } else {
        $GE = $_POST['GE'];
    }
    if ($_POST['PME'] == "") {
        $PME = "0";
    } else {
        $PME = $_POST['PME'];
    }
    if ($_POST['connu'] == "") {
        $connu = "0";
    } else {
        $connu = $_POST['connu'];
    }
    if ($_POST['inconnu'] == "") {
        $inconnu = "0";
    } else {
        $inconnu = $_POST['inconnu'];
    }
    if ($_POST['aimer'] == "") {
        $aimer = "0";
    } else {
        $aimer = $_POST['aimer'];
    }
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    header('Location: index.php?page=Recherche&communication=' . $communication . '&graphisme=' . $graphisme . '&developpement=' . $developpement . '&GE=' . $GE . '&PME=' . $PME . '&connu=' . $connu . '&inconnu=' . $inconnu . '&aimer=' . $aimer . '&ville=' . $ville . '&pays=' . $pays . '');
}


$param = array(
    "communication" => $communication,
    "graphisme" => $graphisme,
    "developpement" => $developpement,
    "connu" => $connu,
    "inconnu" => $inconnu,
    "PME" => $PME,
    "GE" => $GE,
    "aimer" => $aimer,
    "ville" => $ville,
    "pays" => $pays,
    "listePays" => $listePays,
    "listeEntreprise" => $listeEntreprise
);

if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

}

/*
echo "<pre>";
print_r($param);
echo "</pre>";
*/
?>