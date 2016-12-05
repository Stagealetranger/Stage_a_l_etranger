<?php

require_once('class.Papier.php');
require_once('class.Personne.php');
require_once('class.Type.php');

class Entreprise
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd : lesTypes    // generateAssociationEnd : laVille    // generateAssociationEnd : lesPersonnesDeja    // generateAssociationEnd : lesPersonnesVont    // generateAssociationEnd : lesPapiers

    // --- ATTRIBUTES ---
    private $id = 0;
    private $nom = null;
    private $visiter = false;
    private $avis = false;
    private $taille = false;
    private $description = null;
    private $rue = null;
    private $profil = null;
    private $ville = null;

    private $lesTypes = array();
    
    private $lesPersonnesVont = array();


    // --- OPERATIONS ---
    public function __construct($id = 0, $nom = null, $visiter = false, $avis = false, $taille = false, $description = null, $rue = null, $profil = null, $ville = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->visiter = $visiter;
        $this->avis = $avis;
        $this->taille = $taille;
        $this->description = $description;
        $this->rue = $rue;
        $this->profil = $profil;
        $this->ville = $ville;
    }
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getNom(){return $this->nom;}
    public function setNom($nom){$this->nom = $nom;}
    public function getVisiter(){return $this->visiter;}
    public function setVisiter($visiter){$this->visiter = $visiter;}
    public function getAvis(){return $this->avis;}
    public function setAvis($avis){$this->avis = $avis;}
    public function getTaille(){return $this->taille;}
    public function setTaille($taille){$this->taille = $taille;}
    public function getDescription(){return $this->description;}
    public function setDescription($description){$this->description = $description;}
    public function getRue(){return $this->rue;}
    public function setRue($rue){$this->rue = $rue;}
    public function getProfil(){return $this->profil;}
    public function setProfil($profil){$this->profil = $profil;}
    public function getVille(){return $this->ville;}
    public function setVille($ville){$this->ville = $ville;}
    public function getLesTypes(){return $this->lesTypes;}
    public function setLesTypes($lesTypes){$this->lesTypes = $lesTypes;}
    public function getLesPersonnesVont(){return $this->lesPersonnesVont;}
    public function setLesPersonnesVont($lesPersonnesVont){$this->lesPersonnesVont = $lesPersonnesVont;}


} /* end of class Entreprise */

?>