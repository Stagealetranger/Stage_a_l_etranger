<?php

require_once 'dao/DaoSuivit.php';
require_once 'dao/DaoPapier.php';
require_once 'dao/DaoPays.php';


date_default_timezone_set('Europe/Paris');

$script_tz = date_default_timezone_get();

$daoPays = new DaoPays();


$daoSuivit = new DaoSuivit();
$daoSuivit->find($_SESSION["id_suivit"]);
$daoPays->find($daoSuivit->bean->getLePays());
$daoSuivit->setCompose();

if (sizeof($daoSuivit->getlisteCompose()) === 0) {

    $JourDateFinal = 20;
    $MoisDateFinal = 3;
    $AnneeDateFinal = 2017;

    $JourDate = $JourDateFinal - 30;
    $MoisDate = $MoisDateFinal;
    $AnneeDate = $AnneeDateFinal;
    $AnneeDateFin = $AnneeDateFinal;

    if ($MoisDate == 1 | 3 | 5 | 8 | 10 | 12) {
        if ($JourDate < 0) {
            $var = -1;
            for ($j = 0; $var < 0; $j++) {
                if ($j == 0) {
                    $var = $JourDate + 31;

                } else {
                    $var = $var + 31;

                }
            }
            $Quotien = ($j);

            $MoisDateFin = $MoisDate - $Quotien;

            $JourDateFin = $JourDate + 30;


            if ($MoisDate <= 0) {
                $AnneeDateFin = $AnneeDate - 1;
                $MoisDateFin = $MoisDateFin + 12;
            }
        }
    } else {
        if ($JourDate < 0) {

            $var = 0;
            for ($j = 0; $var < 0; $j++) {
                if ($j == 0) {
                    $var = $JourDate + 30;


                } else {
                    $var = $var + 30;

                }
            }
            $Quotien = ($j);

            $MoisDateFin = $MoisDate - $Quotien;
            $JourDateFin = $JourDate + 31;


            if ($MoisDate <= 0) {
                $AnneeDateFin = $AnneeDate - 1;
                $MoisDateFin = $MoisDateFin + 12;
            }
        }
    }
//    var_dump($JourDateFin);
//    var_dump($MoisDateFin);
//    var_dump($AnneeDateFin);

    $listePapier = $daoSuivit->getlisteByPays();
    for ($i = 0; $i < count($listePapier); $i++) {


        $daoPapier = new DaoPapier();
        $daoPapier->find($listePapier[$i]->getId());

        $JourDate = $JourDateFin - $daoPapier->bean->getDuree();
        $var = $JourDateFin - $daoPapier->bean->getDuree();


        if ($MoisDateFin == 1 | 3 | 5 | 8 | 10 | 12) {

            for ($j = 0; $var < 0; $j++) {
                if ($j == 0) {
                    $var = $JourDate + 31;


                } else {
                    $var = $var + 31;
                }
            }
            $Quotien = $j;
            $MoisDate = $MoisDateFin - $Quotien;

            $JourDate = $var;
            if ($JourDate <= 0) {
                $JourDate = $JourDate + 30;
            }
            if ($MoisDate <= 0) {
                $AnneeDate = $AnneeDateFin - 1;
                $MoisDate = $MoisDate + 12;
            }

        } else {
            if ($JourDate < 0) {

                for ($j = 0; $var < 0; $j++) {
                    if ($j == 0) {
                        $var = $JourDate + 30;

                    } else {
                        $var = $var + 30;

                    }
                }

                $Quotien = $j;

                $MoisDate = $MoisDateFin - $Quotien;
                $JourDate = $var;
                if ($JourDate <= 0) {
                    $JourDate = $JourDate + 31;
                }

                if ($MoisDate <= 0) {
                    $AnneeDate = $AnneeDateFin - 1;
                    $MoisDate = $MoisDate + 12;
                }
            }
        }

//
//        if ($MoisDate == 1) {
//            $Mois = "Janvier";
//        }
//        if ($MoisDate == 2) {
//            $Mois = "Frevrier";
//        }
//        if ($MoisDate == 3) {
//            $Mois = "Mars";
//        }
//        if ($MoisDate == 4) {
//            $Mois = "Avril";
//        }
//        if ($MoisDate == 5) {
//            $Mois = "Mai";
//        }
//        if ($MoisDate == 6) {
//            $Mois = "Juin";
//        }
//        if ($MoisDate == 7) {
//            $Mois = "Juillet";
//        }
//        if ($MoisDate == 8) {
//            $Mois = "Août";
//        }
//        if ($MoisDate == 9) {
//            $Mois = "Septembre";
//        }
//        if ($MoisDate == 10) {
//            $Mois = "Octobre";
//        }
//        if ($MoisDate == 11) {
//            $Mois = "Novembre";
//        }
//        if ($MoisDate == 12) {
//            $Mois = "Decembre";
//        }

        $date = "$AnneeDate-$MoisDate-$JourDate";

        $daoSuivit->addCompose($daoPapier->bean->getId(), $date);
        $listePapier[$i] = $daoPapier->bean;
    }
}


//mail


date_default_timezone_set('Europe/Paris');

$script_tz = date_default_timezone_get();
// variable du jours
$joursA = date("d");
$moisA = date("m");
$anneA = date("Y");


$param = array(
    "ent" => $daoSuivit,
    "pays" => $daoPays
);


$dao = new DaoSuivit();
$dao->find($_SESSION['id_suivit']);

$listeForMail = $daoSuivit->getlisteCompose();

for ($i = 0; $i < count($listeForMail); $i++) {
    $info = $dao->findDonner($listeForMail[$i]->getId());

    $info['effectuer'];
    $info['date_val'];

    $date = explode("-", $info['date_val']);
//    var_dump($date);

    $validation = false;
    $date[2] = $date[2] - 10;
    if ($date[2]< 1) {

        var_dump("passe");
        $date[1] = $date[1] - 1;
        var_dump('mois:' . $date[1]);
        $date[2] = $date[2] + 30;
        var_dump('jour:' . $date[2]);

        if ($date[1] - 1 < 1) {
            var_dump('boucle annee');
            $date[1] = $date[1] + 12;
            var_dump('mois:' . $date[1]);
            $date[0]=$date[0]-1;
        }
    }

    if($date[0]==$anneA && $date[1]= $moisA && $date[2]==$joursA){
        $validation = true;
    }

    if ($info['effectuer'] == 0 && $validation) {

        $mail =$_SESSION['mail']; // Déclaration de l'adresse de destination.
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
        $message_html = "<html><head></head><body><br>Bonjour,</br>Je tiens a vous signaler que vous n'avez plus que dix jours afin de realiser votre papier afin de rester dans les temps<i>script PHP</i>.</body></html>";
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

}

//echo "<pre>";
//print_r($param);
//echo "</pre>";


if (isset($_POST["suivit"])) {
    var_dump("ok");
}








if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

}


?>