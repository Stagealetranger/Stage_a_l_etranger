<?php
require_once('class.Entreprise.php');
require_once('class.Papier.php');
require_once('class.Suivit.php');

class Personne
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd : lesPapiers    // generateAssociationEnd : leSuivit    // generateAssociationEnd : lesEntreprisesAccueil    // generateAssociationEnd : lesEntreprisesOnAccueili

    // --- ATTRIBUTES ---

    private $id = 0;
    private $nom = null;
    private $prenom = null;
    private $mail = null;
    private $admin = false;
    private $photo = null;
    private $mdp = null;

    private $lesPapiers = array();
    private $leSuivit = null;
    private $lesEntreprisesAccueil = array();
    private $lesEntreprisesOnAccueilli = array ();



    // --- OPERATIONS ---
    public function __construct($id=0, $nom=null, $prenom=null, $mail=null, $admin=false, $photo=null, $mdp=null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->admin = $admin;
        $this->photo = $photo;
        $this->mdp = $mdp;
    }
    
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}
    public function getNom(){return $this->nom;}
    public function setNom($nom){$this->nom = $nom;}
    public function getPrenom(){return $this->prenom;}
    public function setPrenom($prenom){$this->prenom = $prenom;}
    public function getMail(){return $this->mail;}
    public function setMail($mail){$this->mail = $mail;}
    public function getAdmin(){return $this->admin;}
    public function setAdmin($admin){$this->admin = $admin;}
    public function getPhoto(){return $this->photo;}
    public function setPhoto($photo){$this->photo = $photo;}
    public function getMdp(){return $this->mdp;}
    public function setMdp($mdp){$this->mdp = $mdp;}
    public function getLesPapiers(){return $this->lesPapiers;}
    public function setLesPapiers($lesPapiers){$this->lesPapiers = $lesPapiers;}
    public function getLeSuivit(){return $this->leSuivit;}
    public function setLeSuivit($leSuivit){$this->leSuivit = $leSuivit;}
    public function getLesEntreprisesAccueil(){return $this->lesEntreprisesAccueil;}
    public function setLesEntreprisesAccueil($lesEntreprisesAccueil){$this->lesEntreprisesAccueil = $lesEntreprisesAccueil;}
    public function getLesEntreprisesOnAccueilli(){return $this->lesEntreprisesOnAccueilli;}
    public function setLesEntreprisesOnAccueilli($lesEntreprisesOnAccueilli){$this->lesEntreprisesOnAccueilli = $lesEntreprisesOnAccueilli;}
} /* end of class Personne */

?>