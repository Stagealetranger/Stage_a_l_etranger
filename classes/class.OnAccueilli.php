<?php
require_once('class.Entreprise.php');
require_once('class.Personne.php');

class OnAccueilli extends Personne
{
    private $description_avis = null;

    public function OnAccueilli($id = 0, $nom = null, $prenom = null, $mail = null, $admin = 0, $mdp = null, $photo = null, $leSuivit = 0, $description_avis = null)
    {
        parent::__construct($id, $nom, $prenom, $mail, $admin, $mdp, $photo, $leSuivit);
        
        $this->description_avis = $description_avis;
    }


    public function getDescriptionAvis(){return $this->description_avis;}
    public function setDescriptionAvis($description_avis){$this->description_avis=$description_avis;}





}