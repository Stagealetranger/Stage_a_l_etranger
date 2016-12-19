<?php


$param = array(
    "nom" => $_GET["nom"]

);

$DaoEntreprise = new DaoEntreprise();




if (isset($_POST["valider"])) {
    // Instanciation du Dao qui permettra la création
    $DaoEntreprise = new DaoEntreprise();
    // Chargement du nom sur le bean du dao
    $DaoEntreprise->bean->setLesTypes();




    $DaoEntreprise->create();
    header('Location: index.php?page=listeEntreprise');
    exit();
}



echo "<pre>";
print_r($param);
echo "</pre>";



if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

} else {
    if ((($_SESSION['admin']) == "0")) {
        header('Location: index.php?page=Etudiant');
    }
}

?>