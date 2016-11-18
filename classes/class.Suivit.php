<?php

require_once('class.Papier.php');
require_once('class.Personne.php');

class Suivit
{
    private $id = 0;
    private $effectuer = false;

    private $lesPapiers = array();
    private $lesPersonnes = array();
    

    // --- OPERATIONS ---

    public function __construct($effectuer=false, $id=0)
    {
        $this->effectuer = $effectuer;
        $this->id = $id;
    }
    
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getEffectuer(){return $this->effectuer;}
    public function setEffectuer($effectuer){$this->effectuer = $effectuer;}
    public function getLesPapiers(){return $this->lesPapiers;}
    public function setLesPapiers($lesPapiers){$this->lesPapiers = $lesPapiers;}
    public function getLesPersonnes(){return $this->lesPersonnes;}
    public function setLesPersonnes($lesPersonnes){$this->lesPersonnes = $lesPersonnes;}
    
} 

?>