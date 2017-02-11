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
    private $profil = null;
    private $rue = null;
    private $longitude = 0;
    private $latitude = 0;
    private $ville = null;
    private $contact = null;
    private $telephone = null;
    private $lePays = null;
    private $lesTypes = array();
    private $lesPersonnesVont = array();
    private $SontAller = array();



    // --- OPERATIONS ---
    public function __construct($id = 0, $nom = null, $visiter = false, $avis = false, $taille = false, $description = null, $profil=null, $rue = null, $profil = null, $longitude = 0, $latitude = 0, $ville = null, $contact = null, $telephone = 0)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->visiter = $visiter;
        $this->avis = $avis;
        $this->taille = $taille;
        $this->description = $description;
        $this->rue = $rue;
      
        $this->latitude = $latitude;
        $this->plongitude = $longitude;
        $this->ville = $ville;
        $this->contact = $contact;
        $this->telephone = $telephone;
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
    public function getLePays(){return $this->lePays;}
    public function setLePays($lePays){$this->lePays = $lePays;}
    public function getLesTypes(){return $this->lesTypes;}
    public function setLesTypes($lesTypes){$this->lesTypes = $lesTypes;}
    public function getLesPersonnesVont(){return $this->lesPersonnesVont;}
    public function setLesPersonnesVont($lesPersonnesVont){$this->lesPersonnesVont = $lesPersonnesVont;}
    public function getSontAller(){return $this->SontAller;}
    public function setSontAller($SontAller){$this->SontAller = $SontAller;}
    public function getLongitude(){return $this->longitude;}
    public function setLongitude($longitude){$this->longitude = $longitude;}
    public function getLatitude(){return $this->latitude;}
    public function setLatitude($latitude){$this->latitude = $latitude;}
    public function getContact(){return $this->contact;}
    public function setContact($contact){$this->contact = $contact;}
    public function getTelephone(){return $this->telephone;}
    public function setTelephone($telephone){$this->telephone = $telephone;}




} /* end of class Entreprise */

?>