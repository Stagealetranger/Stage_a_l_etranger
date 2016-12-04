
<?php
require_once 'dao/DaoValidation.php';
require_once 'dao/DaoPersonne.php';


$daoValidation = new DaoValidation();


$listeValidation = $daoValidation ->getListe();


for ($i = 0; $i < count($listeValidation); $i++) {

    $daoValidation = new DaoValidation();

    $daoValidation->find($listeValidation[$i]->getId());

    $listeValidation[$i] = $daoValidation->bean;
}


if (isset($_POST["accepter"])) {
    // Instanciation du Dao qui permettra la création
    $daoValidation->find($_GET["id"]);

    $daoPersonne = new DaoPersonne();
    $daoPersonne->bean->setNom($daoValidation->bean->getNom());
    $daoPersonne->bean->setPrenom($daoValidation->bean->getPrenom());
    $daoPersonne->bean->setMail($daoValidation->bean->getMail());
    $daoPersonne->bean->setMdp($daoValidation->bean->getMdp());

    $daoPersonne->create();
    $daoValidation->delete();
    header('Location: index.php?page=listeValidation');
}

if (isset($_POST["refuser"])) {
    $daoValidation = new DaoValidation();
    $daoValidation->find($_GET["id"]);
    $daoValidation->delete();
    
    header('Location: index.php?page=listeValidation');
}


$param = array(
    "session" => $_SESSION,
    "listeValidation" => $listeValidation
);



echo "<pre>";
print_r($param);
echo "</pre>";














