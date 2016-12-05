<?php
require_once('class.Entreprise.php');

class OnAccueilli extends Entreprise
{
    private $description_avis = 0;
    private $lesPersonnesDeja = array();

    public function OnAccueilli($id = 0, $nom = null, $visiter = false, $avis = false, $taille = false, $description = null, $rue = null, $description_avis = null, $profil = null, $pays = null, $ville = null, $description_avis=0)
    {
        // --- Appel du constructeur de la classe m�re ---
        // Ici la classe Casque pour lequel il faut id, nom et cout
        parent::__construct($id = 0, $nom = null, $visiter = false, $avis = false, $taille = false, $description = null, $rue = null, $description_avis = null, $profil = null, $pays = null, $ville = null);
        // --- On compl�te ensuite la construction de l'objet
        // --- En initialisant les attributs restants
        $this->description_avis = $description_avis;
    }

    public function getDescriptionAvis() {return $this->description_avis;}
    public function setDescriptionAvis($description_avis){$this->description_avis=$description_avis;}

    public function getLesPersonnesDeja(){return $this->lesPersonnesDeja;}
    public function setLesPersonnesDeja($lesPersonnesDeja){$this->lesPersonnesDeja = $lesPersonnesDeja;}
}