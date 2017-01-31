<?php

require_once 'dao/DaoPersonne.php';
require_once 'dao/DaoSuivit.php';

$daoSuivit = new DaoSuivit();

$daoSuivit->find($_SESSION["id_suivit"]);


if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');
}



$param = array(
  "session" => $_SESSION,
    "suivit" =>$daoSuivit
);

echo "<pre>";
print_r($param);
echo "</pre>";

