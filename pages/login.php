
<?php
require_once('dao/DaoPersonne.php');
$daoPersonne = new DaoPersonne;




if ($_SESSION != ''){
    session_unset();
}



if(isset($_POST["connexion"])) {
    $daoPersonne->connect($_POST["mail"],sha1($_POST["mdp"]));
    $_SESSION['id'] = $daoPersonne->bean->getId();
    $_SESSION['nom'] = $daoPersonne->bean->getNom();
    $_SESSION['prenom'] = $daoPersonne->bean->getPrenom();
    $_SESSION['mail'] = $daoPersonne->bean->getMail();
    $_SESSION['admin'] = $daoPersonne->bean->getAdmin();
    $_SESSION['photo'] = $daoPersonne->bean->getPhoto();
    $_SESSION['mdp'] = $daoPersonne->bean->getMdp();

    if(isset($_SESSION['mail'])) {
        header("Location:index.php?page=Etudiant");
    }
    else {
        header("Location:index.php?page=accueil#myModal");
    }

}



?>