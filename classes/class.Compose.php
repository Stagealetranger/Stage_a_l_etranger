<?php
require_once('class.Suivit.php');

class Compose extends Suivit
{
    private $effectuer = false;
    private $date = null;

    private $setlesPapiers = array();

    public function Compose($id=0, $effectuer=false, $date=null)
    {
        parent::__construct($id = 0);

        $this->effectuer = $effectuer;
        $this->date = $date;
    }

    public function getEffectuer() {return $this->effectuer;}
    public function setEffectuer($effectuer){$this->effectuer=$effectuer;}

    public function getDate(){return $this->date;}
    public function setDate($date){$this->date = $date;}
    
    public function getSetlesPapiers(){return $this->setlesPapiers;}
    public function setSetlesPapiers($setlesPapiers){$this->setlesPapiers = $setlesPapiers;}
    

}