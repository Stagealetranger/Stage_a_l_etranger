
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

$param = array(
    "session" => $_SESSION,
    "listeValidation" => $listeValidation
);


if (isset($_POST["accepter"])) {
    // Instanciation du Dao qui permettra la création
    $daoValidation->find($id);

    $daoPersonne->bean->setNom($_POST['nom']);
    $daoPersonne->bean->setPrenom($_POST['prenom']);
    $daoPersonne->bean->setMail($_POST['mail']);
    $daoPersonne->bean->setMdp(sha1($_POST['mdp']));

    $daoPersonne->create();
    header('Location: index.php?page=listeValidation');
}

if (isset($_POST["refuser"])) {
    $daoValidation = new DaoValidation();
    $daoValidation->findById();
    $daoValidation->deleteById();
    
    header('Location: index.php?page=listeValidation');
}

echo "<pre>";
print_r($param);
echo "</pre>";














