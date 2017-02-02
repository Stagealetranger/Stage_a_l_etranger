<?php
require_once 'dao/DaoSuivit.php';
require_once 'dao/DaoPersonne.php';


$dao = new DaoPersonne();
$dao->find($_SESSION["id"]);


if (isset($_POST["valider"])) {
    $dao->bean->setNom($_POST["nom"]);
    $dao->bean->setPrenom($_POST["prenom"]);
    $dao->bean->setMail($_POST["mail"]);
    $dao->update();
    header('Location: index.php?page=modifProfil');
}

if (isset($_POST["valider2"])) {
    $dao->bean->setMdp(sha1($_POST["mdp"]));
    $dao->updateMdp();
    header('Location: index.php?page=modifProfil');
}
if (isset($_POST["valider3"])) {
// Sil y a un fichier, on remplace l'ancien
    if ($_FILES['image']['name'] != "") {
        // Nom du fichier
        $image = $_FILES['image']['name'];
        // Suppression de l'ancien
        if (file_exists("imagesappli/" . $dao->bean->getPhoto())) {
            unlink("imagesappli/" . $dao->bean->getPhoto());
        }
        if (move_uploaded_file($_FILES['image']['tmp_name'], "imagesappli/" . $image)) {
            // Si on a pu deplacer le fichier telecharge,
            // On cree la personne
            $dao->bean->setPhoto($image);
        }
    }
}
$dao->updatePhoto();


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');
}


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');
}
$param = array(
    "personne" => $dao->bean
);

?>



