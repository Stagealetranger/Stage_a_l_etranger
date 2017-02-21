<?php

require_once 'dao/DaoPays.php';


$daoPays = New DaoPays();


$listePays = $daoPays->getListe();
for ($i = 0; $i < count($listePays); $i++) {
    $daoPays = new DaoPays();
    $daoPays->find($listePays[$i]->getId());
    $listePays[$i] = $daoPays->bean;
}


if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}else{
    if ((($_SESSION['admin']) == "0")){
        header('Location: index.php?page=Etudiant');
    }

}


$param = array(
    "liste" => $listePays
);