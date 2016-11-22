<?php



$param = array( "session" => $_SESSION);

if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}


?>