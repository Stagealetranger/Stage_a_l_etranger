<?php


if (isset($_POST["recherche"])) {
    $communication = $_POST['communication'];
    $graphisme = $_POST['graphisme'];
    $developpement = $_POST['developpement'];
    $GE = $_POST['GE'];
    $PME = $_POST['PME'];
    $connu = $_POST['connu'];
    $inconnu = $_POST['inconnu'];
    $aimer = $_POST['aimer'];
    header('Location: index.php?page=Recherche&communication='.$communication.'&graphisme='.$graphisme.'&developpement='.$developpement.'&GE='.$GE.'&PME='.$PME.'&connu='.$connu.'&inconnu='.$inconnu.'&aimer='.$aimer.'');
}


$param = array(
    "session" => $_SESSION
);

if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

}


echo "<pre>";
print_r($param);
echo "</pre>";

?>