<?php

require_once 'dao/DaoEntreprise.php';
require_once 'dao/DaoType.php';


$daoEntreprise = new DaoEntreprise();
$ville = $_GET["ville"];

$recherche = array(
    'communication' => $_GET['communication'],
    'graphisme' => $_GET['graphisme'],
    'developpement' => $_GET['developpement'],
    'GE' => $_GET['GE'],
    'PME' => $_GET['PME'],
    'connu' => $_GET['connu'],
    'inconnu' => $_GET['inconnu'],
    'aimer' => $_GET['aimer']
);


$graphisme = $_GET['graphisme'];

$listeEntreprise = $daoEntreprise->getListe();

for ($i = 0; $i < count($listeEntreprise); $i++) {
    $daoEntreprise = new DaoEntreprise();
    /*
    if ((($_GET['pays']) != '') | (($_GET['ville']) != '')) {
        if (($_GET['pays']) != '') {
            $daoEntreprise->findPays($listeEntreprise[$i]->get());
          $algotest = "pays";
        }

        if (($_GET['ville']) != '') {
            $daoEntreprise->findVille($listeEntreprise[$i]->getVille());
            $algotest = "ville";
        }
    } else */{
        $daoEntreprise->find($listeEntreprise[$i]->getId());
        $algotest = "noraml";
    }


}
$daoEntreprise->setLesTypes();
$listeEntreprise[$i] = $daoEntreprise->bean;


$param = array(
    "utiliser" =>$algotest,
    "recherche" => $recherche,
    "liste" => $listeEntreprise
);


echo "<pre>";
print_r($param);
echo "</pre>";


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');
}

?>


