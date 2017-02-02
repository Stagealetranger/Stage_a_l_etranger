<?php
require_once 'dao/DaoSuivit.php';
require_once 'dao/DaoPersonne.php';


$dao = new DaoPersonne();
$liste = $dao->getListe();

if(isset($_POST["valider"])){
    $dao->bean->setNom($_POST["nom"]);
    $dao->bean->setPrenom($_POST["prenom"]);
    $dao->bean->setMail($_POST["mail"]);
    $dao->update();
    header('Location: index.php?page=Profil');
}
$param = array(
    "liste" => $liste,
    "personne"=>$dao->bean
);

?>



