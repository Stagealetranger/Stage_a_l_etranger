<?php
require_once('class.Entreprise.php');
require_once('class.Personne.php');

class OnAccueilli extends Entreprise
{
    private $description_avis = null;
    
    
    private $lesEntreprise = array();


    public function __construct($id=0,$nom= null ,$description_avis = null)
    {
       parent::__construct($id, $nom);
        $this->description_avis = $description_avis;
    }


    public function getDescriptionAvis() {return $this->description_avis;}
    public function setDescriptionAvis($description_avis){$this->description_avis=$description_avis;}

}