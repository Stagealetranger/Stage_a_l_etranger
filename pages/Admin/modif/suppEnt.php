<?php
require_once('dao/DaoEntreprise.php');


$daoEntreprise = new DaoEntreprise();
$daoEntreprise->find($_GET["id"]);

if (isset($_POST["oui"])) {
    $daoEntreprise->delete();
    header('Location: index.php?page=listeEntreprise');
    exit();
}
if (isset($_POST["non"])) {
    header('Location: index.php?page=listeEntreprise');
}

$param = array(
    "session" => $_SESSION,
"entreprise" => $daoEntreprise->bean
);


if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}else{
    if ((($_SESSION['admin']) == "0")){
        header('Location: index.php?page=Etudiant');
    }

}

echo "<pre>";
print_r($param);
echo "</pre>";



?>