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




if ($daoSuivit->setCompose() == "") {


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
//        var_dump($date);
//$daoPapier->addCompose($_SESSION["id_suivit"],$date);
        $listePapier[$i] = $daoPapier->bean;
    }
}


$param = array(
    "ent" => $daoSuivit,
    "suivit" => $listePapier,
    "pays" => $daoPays
);


//echo "<pre>";
//print_r($param);
//echo "</pre>";


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

}


?>