<?php
require_once('dao/DaoValidation.php');



if ($_SESSION != ''){
    session_unset();
}

if (isset($_POST["valider"])) {
    // Instanciation du Dao qui permettra la création
    $DaoValidation = new DaoValidation();
    // Chargement du nom sur le bean du dao
    $DaoValidation->bean->setNom($_POST['nom']);
    $DaoValidation->bean->setPrenom($_POST['prenom']);
    $DaoValidation->bean->setMail($_POST['mail']);
    $DaoValidation->bean->setMdp(sha1($_POST['mdp']));
    $DaoValidation->create();
    header('Location: index.php?page=accueil');

$mail =$_POST['mail']; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Bonjour,votre inscription a bien été prise en compte, nous vous enverrons un mail lorsque celle ci sera valider.";
$message_html = "<html><head></head><body><b>Bonjour</b>,votre inscription a bien été prise en compte, nous vous enverrons un mail lorsque celle ci sera valider <i>script PHP</i>.</body></html>";
//==========


//=====Création de la boundary.
$boundary = "-----=".md5(rand());
//==========

//=====Définition du sujet.
$sujet = "Validation Inscription";
//=========

//=====Création du header de l'e-mail.
$header = "From: \"Stage\"<joshua.froehly@gmail.com>".$passage_ligne;
$header.= "Reply-to: \"Stage\" <joshua.froehly@gmail.com>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
//==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========

//=====Envoi de l'e-mail.
    mail($mail,$sujet,$message,$header);
//==========
    exit();
}


?>
