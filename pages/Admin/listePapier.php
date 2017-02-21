<?php

require_once 'dao/DaoPapier.php';
require_once 'dao/DaoPays.php';


$daoPapier = new DaoPapier();
$daoPays = new DaoPays();


$listePapier = $daoPapier->getListe();



for ($i = 0; $i < count($listePapier); $i++) {

    $daoPapier = new DaoPapier();

    $daoPapier->find($listePapier[$i]->getId());
    $daoPapier->setLesPays();
    $daoPapier->setLesSuivits();
    $listePapier[$i] = $daoPapier->bean;
}


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

} else {
    if ((($_SESSION['admin']) == "0")) {
        header('Location: index.php?page=Etudiant');
    }

}


$param = array(
    "liste" => $listePapier
);

echo "<pre>";
print_r($param);
echo "</pre>";
?>






