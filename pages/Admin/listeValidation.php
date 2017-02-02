<?php
require_once 'dao/DaoValidation.php';
require_once 'dao/DaoPersonne.php';
require_once 'dao/DaoSuivit.php';


$daoValidation = new DaoValidation();



$listeValidation = $daoValidation->getListe();


for ($i = 0; $i < count($listeValidation); $i++) {

    $daoValidation = new DaoValidation();

    $daoValidation->find($listeValidation[$i]->getId());

    $listeValidation[$i] = $daoValidation->bean;
}


if (isset($_POST["accepter"])) {

    $daoSuivit = new DaoSuivit();


    // Instanciation du Dao qui permettra la création
    $daoValidation->find($_GET["id"]);

    $daoPersonne = new DaoPersonne();
    $daoPersonne->bean->setNom($daoValidation->bean->getNom());
    $daoPersonne->bean->setPrenom($daoValidation->bean->getPrenom());
    $daoPersonne->bean->setMail($daoValidation->bean->getMail());
    $daoPersonne->bean->setMdp($daoValidation->bean->getMdp());


    $mail = $daoValidation->bean->getid();
    
    $daoSuivit->create($mail);
    $daoSuivit->findNom($mail);
    $idSuvivit = $daoSuivit->bean->getId();
    $daoPersonne->create($idSuvivit);
    $daoValidation->delete();
    $daoSuivit->updateNom($daoSuivit->bean->getId());
    

    $mail = $daoValidation->bean->getMail(); // Déclaration de l'adresse de destination.
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
    {
        $passage_ligne = "\r\n";
    } else {
        $passage_ligne = "\n";
    }
//=====Déclaration des messages au format texte et au format HTML.
    $message_txt = "Bonjour,votre inscription a bien été validée nous vous remercions pour votre attente.";
  
//==========


//=====Création de la boundary.
    $boundary = "-----=" . md5(rand());
//==========

//=====Définition du sujet.
    $sujet = "Inscription validée";
//=========

//=====Création du header de l'e-mail.
    $header = "From: \"Stage\"<joshua.froehly@gmail.com>" . $passage_ligne;
    $header .= "Reply-to: \"Stage\" <joshua.froehly@gmail.com>" . $passage_ligne;
    $header .= "MIME-Version: 1.0" . $passage_ligne;
    $header .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
//==========

//=====Création du message.
    $message = $passage_ligne . "--" . $boundary . $passage_ligne;
//=====Ajout du message au format texte.
    $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"" . $passage_ligne;
    $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
    $message .= $passage_ligne . $message_txt . $passage_ligne;
//==========
    $message .= $passage_ligne . "--" . $boundary . $passage_ligne;
//==========
    $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
    $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
//==========

//=====Envoi de l'e-mail.
    mail($mail, $sujet, $message, $header);
//==========
    header('Location: index.php?page=listeValidation');
}

if (isset($_POST["refuser"])) {
    $daoValidation = new DaoValidation();
    $daoValidation->find($_GET["id"]);
    $daoValidation->delete();

    header('Location: index.php?page=listeValidation');
}





$param = array(
    "session" => $_SESSION,
    "listeValidation" => $listeValidation
);


/*
echo "<pre>";
print_r($param);
echo "</pre>";

*/






 





