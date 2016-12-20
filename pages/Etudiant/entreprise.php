<?php
require_once('dao/DaoEntreprise.php');
require_once('dao/DaoPersonne.php');
require_once ('classes/class.Entreprise.php');

$daoEntreprise = new DaoEntreprise();
$daoPersonne = new DaoPersonne();


$daoEntreprise->find($_GET["id"]);
$daoEntreprise->setLePays();
$daoEntreprise->setLesTypes();

$param = array(
    "entreprise" => $daoEntreprise->bean
);
if (($_SESSION['mail']) == ''){
    header('Location: index.php?page=accueil');

}

require('classes/GoogleMapAPI.class.php');
$latitude= $daoEntreprise->bean->getLatitude();
$longitude = $daoEntreprise->bean->getLongitude();
//(2) On crée une nouvelle carte; Ici, notre carte sera $map.
$map = new GoogleMapAPI('map');

//(3) On ajoute la clef de Google Maps.
$map->setAPIKey('AIzaSyCVOPE4C6-vOhpIsEjp67rKZaRT2NTytMo');

//(4) On ajoute les caractéristiques que l'on désire à notre carte.
$map->setWidth("800px");
$map->setHeight("500px");
$map->setCenterCoords ($longitude,$latitude);
$map->setZoomLevel (5);
$map->disableScaleControl();
$map->disableTypeControls();
$map-> disableOverviewControl();
$map->addMarkerByCoords( $longitude,$latitude);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

<head>
    <title>Ma première carte Google Maps</title>
    <?php $map->printHeaderJS(); ?>
    <?php $map->printMapJS(); ?>
</head>

<body onload="onLoad();">
<?php $map->printMap(); ?>
</body>

</html>

