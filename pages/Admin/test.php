<?php
require_once('dao/DaoEntreprise.php');


$daoEntreprise = new DaoEntreprise();

/*A la place des ****** tu met le nom
 d'une entreprise que tu a deja dans ta bdd*/
$nom = "uuuu";


$daoEntreprise->findByNomEnt($nom);
$daoEntreprise->setLePays();
$daoEntreprise->setLesTypes();

$param = array(
    "entreprise" => $daoEntreprise->bean
);

echo "<pre>";
print_r($param);
echo "</pre>";

?>