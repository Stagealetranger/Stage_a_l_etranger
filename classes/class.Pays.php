<?php

require_once('class.Papier.php');
require_once('class.Entreprise.php');

class Pays
{
    private $id = 0;
    private $nom =null;

    private $lesEntreprise = array();
    private $lesPapiers = array();

  
    public function __construct($nom=null, $id=0)
    {
        $this->nom = $nom;
        $this->id = $id;
    }
    
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getLesPapiers(){return $this->lesPapiers;}
    public function setLesPapiers($lesPapiers){$this->lesPapiers = $lesPapiers;}
    public function getLesEntreprise(){return $this->lesEntreprise;}
    public function setLesEntreprise($lesEntreprise){$this->lesEntreprise = $lesEntreprise;}
    public function getNom(){return $this->nom;}
    public function setNom($nom){$this->nom = $nom;}
    
    


}