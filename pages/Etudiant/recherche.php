<?php

require_once 'dao/DaoEntreprise.php';
require_once 'dao/DaoType.php';
require_once 'dao/DaoPays.php';


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






$daoEntreprise = new DaoEntreprise();

if ((($_GET['pays']) != '') | (($_GET['ville']) != '')) {
    if (($_GET['pays']) != '') {
        $DaoPays = new DaoPays();
        $pays = $_GET['pays'];
        $DaoPays ->findByNom($pays);
        $listeEntreprise = $daoEntreprise->getListeByPays($DaoPays->bean->getID());

    }
    if (($_GET['ville']) != '') {
        $ville = $_GET['ville'];
        $listeEntreprise = $daoEntreprise->getListeByVille($ville);

    }
} else {
    $listeEntreprise = $daoEntreprise->getListe();

}


for ($i = 0; $i < count($listeEntreprise); $i++) {
    $daoEntreprise = new DaoEntreprise();
    $daoEntreprise->find($listeEntreprise[$i]->getId());
    $daoEntreprise->setLesTypes();
    $daoEntreprise->setLePays();
    $listeEntreprise[$i] = $daoEntreprise->bean;
}


$param = array(
    "recherche" => $recherche,
    "liste" => $listeEntreprise
);
/*
echo "<pre>";
print_r($param);
echo "</pre>";
*/

if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');
}

?>
