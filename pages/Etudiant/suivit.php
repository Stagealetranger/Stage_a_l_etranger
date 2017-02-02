<?php

require_once 'dao/DaoSuivit.php';
require_once 'dao/DaoPapier.php';


date_default_timezone_set('Europe/Paris');

$script_tz = date_default_timezone_get();


$daoSuivit = new DaoSuivit();
$daoSuivit->find($_SESSION["id_suivit"]);
$daoSuivit->setCompose();

if ($daoSuivit->setCompose() == "") {


    $JourDateFinal = 20;
    $MoisDateFinal = 3;
    $AnneeDateFinal = 2017;

    $JourDate = $JourDateFinal - 30;
    $MoisDate = $MoisDateFinal;
    $AnneeDate = $AnneeDateFinal;

    if ($MoisDate == 1 | 3 | 5 | 8 | 10 | 12) {
        if ($JourDate < 0) {
            $var = -1;
            for ($j = 0; $var < 0; $j++) {
                if ($j == 0) {
                    $var = $JourDate + 31;
                    $B1 = "boucle1 $var";
                    var_dump($B1);
                } else {
                    $var = $var + 31;
                    $B1 = "boucle2 $var";
                    var_dump($B1);
                }
            }
            $Quotien = ($j);
            $MoisDate = $MoisDate - $Quotien;
            $JourDate = $JourDate + 30;


            if ($MoisDate < 0) {
                $AnneeDate = $AnneeDate - 1;
                $MoisDate = $MoisDate + 12;
            }
        }
    }

    if ($MoisDate == 2 | 4 | 6 | 7 | 9 | 11) {
        if ($JourDate < 0) {

            $var = 0;
            for ($j = 0; $var < 0; $j++) {
                if ($j == 0) {
                    $var = $JourDate + 30;
                    $B1 = "boucle3 $var";
                    var_dump($B1);
                } else {
                    $var = $var + 30;
                    $B1 = "boucle4 $var";
                    var_dump($B1);
                }
            }
            $Quotien = ($j);

            $MoisDate = $MoisDate - $Quotien;
            $JourDate = $JourDate + 31;


            if ($MoisDate < 0) {
                $AnneeDate = $AnneeDate - 1;
                $MoisDate = $MoisDate + 12;
            }
        }
    }
    var_dump($JourDate);
    var_dump($MoisDate);
    var_dump($AnneeDate);

    $listePapier = $daoSuivit->getlisteByPays();
    for ($i = 0; $i < count($listePapier); $i++) {
        var_dump($i);

        $daoPapier = new DaoPapier();
        $daoPapier->find($listePapier[$i]->getId());
        $JourDate = $JourDate - $daoPapier->bean->getDuree();
        $var = $var - $daoPapier->bean->getDuree();

        if ($MoisDate == 1 || $MoisDate == 3 || $MoisDate == 5 || $MoisDate == 8 || $MoisDate == 10 || $MoisDate == 12) {


            if ($JourDate < 0) {
                for ($j = 0; $var < 0; $j++) {
                    if ($j == 0) {
                        $var = $JourDate + 31;
                        $B1 = "boucle1 $var";

                    } else {
                        $var = $var + 31;
                        $B1 = "boucle2 $var";

                    }
                }
                $Quotien = ($j);
                $MoisDate = $MoisDate - $Quotien;
                $JourDate = $var;


                if ($MoisDate < 0) {
                    $AnneeDate = $AnneeDate - 1;
                    $MoisDate = $MoisDate + 12;
                }
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

                $MoisDate = $MoisDate - $Quotien;
                $JourDate = $var;


                if ($MoisDate <= 0) {
                    $AnneeDate = $AnneeDate - 1;
                    $MoisDate = $MoisDate + 12;
                }
            }
        }


        if ($MoisDate == 1) {
            $Mois = "Janvier";
        }
        if ($MoisDate == 2) {
            $Mois = "Frevrier";
        }
        if ($MoisDate == 3) {
            $Mois = "Mars";
        }
        if ($MoisDate == 4) {
            $Mois = "Avril";
        }
        if ($MoisDate == 5) {
            $Mois = "Mai";
        }
        if ($MoisDate == 6) {
            $Mois = "Juin";
        }
        if ($MoisDate == 7) {
            $Mois = "Juillet";
        }
        if ($MoisDate == 8) {
            $Mois = "Août";
        }
        if ($MoisDate == 9) {
            $Mois = "Septembre";
        }
        if ($MoisDate == 10) {
            $Mois = "Octobre";
        }
        if ($MoisDate == 11) {
            $Mois = "Novembre";
        }
        if ($MoisDate == 12) {
            $Mois = "Decembre";
        }

        $date = "$JourDate $Mois $AnneeDate";
        var_dump($date);

//        $daoPapier->addCompose($_SESSION["id_suivit"],$date);
        $listePapier[$i] = $daoPapier->bean;
    }
}


$param = array(
    "suivit" => $daoSuivit,
    "papier" => $listePapier

);


echo "<pre>";
print_r($param);
echo "</pre>";


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

}


?>