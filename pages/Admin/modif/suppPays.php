<?php
require_once('dao/DaoPapier.php');


$daoPays = new DaoPays();
$daoPays->find($_GET["id"]);
$daoPays->setLesPapiers();
$daoPays->setLesEntreprises();

if (isset($_POST["oui"])) {
    $daoPays->delete();
    header('Location: index.php?page=listePays');
    exit();
}
if (isset($_POST["non"])) {
    header('Location: index.php?page=listePays');
}

$param = array(
    "pays" => $daoPays->bean
);


if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}else{
    if ((($_SESSION['admin']) == "0")){
        header('Location: index.php?page=Etudiant');
    }

}

//echo "<pre>";
//print_r($param);
//echo "</pre>";



?>