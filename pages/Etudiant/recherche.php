<?php

require_once 'dao/DaoEntreprise.php';
require_once 'dao/DaoType.php';


$daoEntreprise = new DaoEntreprise();
$daoEntreprise->setLesTypes();


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
    $daoType = new DaoType();
    if ((($_GET['pays']) != '') | (($_GET['ville']) != '')) {
        /*if (($_GET['pays']) != '') {
            $daoEntreprise->findByPays($listeEntreprise[$i]->getId());
          
        }

        if (($_GET['ville']) != '') {
            $daoEntreprise->findByVille($listeEntreprise[$i]->getId());

        }*/
    } else {
        $daoEntreprise->find($listeEntreprise[$i]->getId());
    }


}
$daoEntreprise->setLesTypes();
$daoEntreprise->setPays();

$listeEntreprise[$i] = $daoEntreprise->bean;


$param = array(
    "ville" => $_GET['ville'],
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


