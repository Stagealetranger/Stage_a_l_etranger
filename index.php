<?php

ini_set('display_errors','on');
error_reporting(E_ALL);

define("RACINE", __DIR__);

include_once('Twig/Autoloader.php');
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'debug' => true,
    'cache' => false
));
$uriDemandee = "accueil";
$routes = parse_ini_file("param/routes.ini", true);

// Démarrage des sessions
session_start();


if (isset($_GET["page"])) {
    $uriDemandee = $_GET["page"];
}

$page = $routes[$uriDemandee]["page"];
$template = $routes[$uriDemandee]["template"];

$param = array();

if ($page != null){
    include($page);
}

try{
    $template = $twig->loadTemplate($template);
} catch (Twig_Error_Loader $e) {
    header('Location: index.php?page=Erreur');
}


$param["session"] = $_SESSION;

echo $template->render($param);


?>