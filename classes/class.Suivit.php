<?php

require_once('class.Papier.php');
require_once('class.Personne.php');

class Suivit
{
    private $id = 0;
    
    private $lesPersonnes = array();
    

    // --- OPERATIONS ---

    public function __construct( $id=0)
    {
       
        $this->id = $id;
    }
    
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    
    public function getLesPersonnes(){return $this->lesPersonnes;}
    public function setLesPersonnes($lesPersonnes){$this->lesPersonnes = $lesPersonnes;}
    
} 

?>