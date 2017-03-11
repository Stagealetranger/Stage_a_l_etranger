<?php
require_once('dao/DaoPersonne.php');
$daoPersonne = new DaoPersonne;


session_unset();


if (isset($_POST["connexion"])) {
    $daoPersonne->connect($_POST["mail"], sha1($_POST["mdp"]));
    $_SESSION['id'] = $daoPersonne->bean->getId();
    $_SESSION['nom'] = $daoPersonne->bean->getNom();
    $_SESSION['prenom'] = $daoPersonne->bean->getPrenom();
    $_SESSION['mail'] = $daoPersonne->bean->getMail();
    $_SESSION['admin'] = $daoPersonne->bean->getAdmin();
    $_SESSION['photo'] = $daoPersonne->bean->getPhoto();
    $_SESSION['mdp'] = $daoPersonne->bean->getMdp();
    $_SESSION['id_suivit'] = $daoPersonne->bean->getLeSuivit();


    if (isset($_SESSION['mail'])) {
        header("Location:index.php?page=Etudiant");
    } else {
        header("Location:index.php?page=accueil#myModal");
    }

}

if (isset($_POST["deconnexion"])) {

    unset($_SESSION['id']);
    unset($_SESSION['nom']);
    unset($_SESSION['prenom']);
    unset($_SESSION['mail']);
    unset($_SESSION['admin']);
    unset($_SESSION['photo']);
    unset($_SESSION['mdp']);
    unset($_SESSION['id_suivit']);

    header("Location:index.php?page=accueil");

}

if (isset($_POST["non"])) {
    header("Location:index.php?page=Etudiant");
}

?>