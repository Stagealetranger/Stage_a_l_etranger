<?php

require_once 'dao/DaoSuivit.php';
require_once 'dao/DaoPapier.php';

$idPays=1;
$idDateLimite = (20/03/2017);

$daoPapier = new DaoPapier();

//simple fonction a changer
$listePapier = $daoPapier->getListe();
for ($i = 0; $i < count($listePapier); $i++) {
    $daoPapier = new DaoPapier();
    $daoPapier->find($listePapier[$i]->getId());


    $param = array(
        "liste" => $listePapier,
        
    );



    $listePapier[$i] = $daoPapier->bean;
}








if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}


?>