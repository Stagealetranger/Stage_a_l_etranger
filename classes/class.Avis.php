<?php


require_once('class.Personne.php');
require_once('class.Entreprise.php');



class Avis extends Entreprise
{

    private $avis = 0;


    public function __construct($avis){$this->avis = $avis;}

    public function getAvis(){return $this->avis;}
    public function setAvis($avis){$this->avis = $avis;}




} /* end of class Entreprise */

?>