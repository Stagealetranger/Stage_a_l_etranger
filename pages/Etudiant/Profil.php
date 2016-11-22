<?php

require_once 'dao/DaoPersonne.php';



if (($_SESSION['mail']) == '') {
    header('Location: index.php?page=accueil');

}



$param = array(
    "session" => $_SESSION
);

