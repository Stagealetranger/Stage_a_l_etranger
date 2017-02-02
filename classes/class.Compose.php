<?php
require_once('class.Papier.php');
require_once('class.Suivit.php');

class Compose extends Papier
{
    private $effectuer = false;
    private $date = null;


    public function Compose($id = 0, $nom = null, $conseil = null, $duree = 0, $effectuer = false, $date = null)
    {
        parent::__construct($id, $nom, $conseil, $duree);
        $this->effectuer = $effectuer;
        $this->date = $date;
    }

    public function getEffectuer(){return $this->effectuer;}

    public function setEffectuer($effectuer){$this->effectuer = $effectuer;}

    public function getDate(){return $this->date;}

    public function setDate($date){$this->date = $date;}


}