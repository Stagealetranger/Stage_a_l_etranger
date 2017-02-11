<?php
require_once('class.Papier.php');
require_once('class.Suivit.php');

class Compose extends Papier
{
    private $effectuer = false;
    private $date_val = null;


    public function Compose($id = 0, $nom = null,$description = null, $conseil = null, $duree = 0, $effectuer = false, $date_val = null)
    {
        parent::__construct($id, $nom,$description, $conseil, $duree);
        $this->effectuer = $effectuer;
        $this->date_val = $date_val;
    }

    public function getEffectuer(){return $this->effectuer;}

    public function setEffectuer($effectuer){$this->effectuer = $effectuer;}


    public function getDateVal(){return $this->date_val;}

    public function setDateVal($date_val){$this->date_val = $date_val;}





}