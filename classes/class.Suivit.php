<?php

require_once('class.Papier.php');
require_once('class.Personne.php');

class Suivit
{
    private $id = 0;
    private $nom = null;
    
    private $lesPersonnes = array();
    private $lePays = null;


    // --- OPERATIONS ---

    public function __construct( $id=0, $nom=null)
    {
       
        $this->id = $id;
    }
    
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getNom(){return $this->nom;}
    public function setNom($nom){$this->nom = $nom;}

    public function getLePays(){return $this->lePays;}
    public function setLePays($lePays){$this->lePays = $lePays;}

    public function getLesPersonnes(){return $this->lesPersonnes;}
    public function setLesPersonnes($lesPersonnes){$this->lesPersonnes = $lesPersonnes;}
    
} 

?>