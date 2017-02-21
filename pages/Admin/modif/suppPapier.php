<?php
require_once('dao/DaoPapier.php');

$daoPapier = new DaoPapier();
$daoPapier->find($_GET["id"]);
$daoPapier->setLesPays();
$daoPapier->setLesPersonnes();


if (isset($_POST["oui"])) {
    $daoPapier->delete();
    header('Location: index.php?page=listePapier');
}
if (isset($_POST["non"])) {
    header('Location: index.php?page=listePapier');
}

$param = array(
    "papier" => $daoPapier->bean,
);



if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}else{
    if ((($_SESSION['admin']) == "0")){
        header('Location: index.php?page=Etudiant');
    }

}
?>