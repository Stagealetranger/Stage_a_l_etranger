<?php

require_once('class.Personne.php');
require_once('class.Suivit.php');


class Papier
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd : lesPays    // generateAssociationEnd : lesSuivits    // generateAssociationEnd : lesPersonnes    // generateAssociationEnd : lesEntreprises

    // --- ATTRIBUTES ---

    private $id = 0;
    private $nom = null;
    private $description = null;
    private $conseil = null;
    private $duree = 0;
    private $pays = null;

    private $lesSuivits = array();
    private $lesPersonnes = array();


    // --- OPERATIONS ---
    public function __construct($id=0, $nom=null, $description=null, $conseil=null, $duree=null, $pays=null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->conseil = $conseil;
        $this->duree = $duree;
        $this->pays = $pays;
    }
    
    public function getLesPersonnes(){return $this->lesPersonnes;}
    public function setLesPersonnes($lesPersonnes){$this->lesPersonnes = $lesPersonnes;}
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getNom(){return $this->nom;}
    public function setNom($nom){$this->nom = $nom;}
    public function getDescription(){return $this->description;}
    public function setDescription($description){$this->description = $description;}
    public function getConseil(){return $this->conseil;}
    public function setConseil($conseil){$this->conseil = $conseil;}
    public function getDuree(){return $this->duree;}
    public function setDuree($duree){$this->duree = $duree;}
    public function getPays(){return $this->pays;}
    public function setPays($pays){$this->pays = $pays;}
    public function getLesSuivits(){return $this->lesSuivits;}
    public function setLesSuivits($lesSuivits){$this->lesSuivits = $lesSuivits;}

} 

?>